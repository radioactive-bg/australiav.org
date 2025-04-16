# Makefile for local dev workflow

# Load environment variables from .env file
ifneq (,$(wildcard ./.env))
	include .env
	export
endif

# Variables
# ------------------------------------------------------------------------------
DOCKER_COMPOSE = docker compose -f docker-compose-local.yml
DB_SERVICE = australiav_db
DB_DUMP_FILE = australiav-db-dump.sql
TARGET_DOMAIN ?= https://australiav.org

# 1. Setup: builds and starts containers in the background, waits for MySQL to be ready, and restores the database
setup:
	$(DOCKER_COMPOSE) up --build -d
	@echo "Waiting for MySQL to be ready..."
	@while ! $(DOCKER_COMPOSE) exec $(DB_SERVICE) mysql -u$(DB_USER) -p$(DB_PASSWORD) -e "SHOW DATABASES;" 2>/dev/null; do \
		echo "MySQL not ready. Retrying..."; \
		sleep 2; \
	done
	@echo "MySQL is ready. Checking and restoring the database..."
	@if [ -f $(DB_DUMP_FILE) ]; then \
		$(DOCKER_COMPOSE) exec $(DB_SERVICE) mysql -u$(DB_USER) -p$(DB_PASSWORD) $(DB_NAME) < $(DB_DUMP_FILE) 2>/dev/null || true; \
		echo "Database restored from $(DB_DUMP_FILE)."; \
	fi
	@echo "Verifying table $(DB_TABLE_PREFIX)options exists..."
	@while ! $(DOCKER_COMPOSE) exec $(DB_SERVICE) mysql -u$(DB_USER) -p$(DB_PASSWORD) -e "SELECT 1 FROM $(DB_TABLE_PREFIX)options LIMIT 1;" $(DB_NAME) 2>/dev/null; do \
		echo "Table $(DB_TABLE_PREFIX)options not found. Retrying..."; \
		sleep 2; \
	done
	@$(MAKE) update-siteurl
	@$(DOCKER_COMPOSE) exec -it australiav_wordpress sh -c "chown -R www-data:www-data wp-content && chmod -R 775 wp-content"
#   @if ! getent group 82 >/dev/null; then sudo groupadd -g 82 containerwww; fi && if ! groups $USER | grep -qw containerwww; then sudo usermod -a -G containerwww $USER; fi

	@echo "Local environment has been setup successfully."

# 2. Export DB: dumps the database to db_dump.sql
export-db:
	@$(DOCKER_COMPOSE) exec $(DB_SERVICE) mysqldump -u$(DB_USER) -p$(DB_PASSWORD) $(DB_NAME) > $(DB_DUMP_FILE)
	@echo "Database exported to $(DB_DUMP_FILE)."

# 3. Update siteurl and home
update-siteurl:
	@$(DOCKER_COMPOSE) exec -e MYSQL_PWD="$(DB_PASSWORD)" $(DB_SERVICE) mysql -u$(DB_USER) $(DB_NAME) -e "UPDATE $(DB_TABLE_PREFIX)options SET option_value = 'http://localhost:6060' WHERE option_name IN ('siteurl','home');"
	@echo "Updated siteurl and home."

# 4. Revert siteurl and home
revert-siteurl:
	@$(DOCKER_COMPOSE) exec -e MYSQL_PWD="$(DB_PASSWORD)" $(DB_SERVICE) mysql -u$(DB_USER) $(DB_NAME) -e "UPDATE $(DB_TABLE_PREFIX)options SET option_value = '$(TARGET_DOMAIN)' WHERE option_name IN ('siteurl','home');"
	@echo "Reverted siteurl and home to $(TARGET_DOMAIN)."

# 5. Stop local environment
stop:
	$(DOCKER_COMPOSE) down -v
	@echo "Stopped containers and removed volumes."

# 6. Commit & Push: Replaces localhost URLs, exports DB, commits & pushes
push:
	@if ! $(DOCKER_COMPOSE) ps $(DB_SERVICE) | grep -q "Up"; then \
		echo "Error: The local environment is not running."; \
		echo "Please start the environment first using:"; \
		echo "    make setup"; \
		echo "Then re-run this command."; \
		exit 1; \
	fi	
	@$(DOCKER_COMPOSE) exec $(DB_SERVICE) mysql -uroot -p'$(MYSQL_ROOT_PASSWORD)' -e "GRANT PROCESS ON *.* TO '$(DB_USER)'@'%'; FLUSH PRIVILEGES;"
	@echo "Replacing localhost URLs with $(TARGET_DOMAIN)..."
	@$(MAKE) safe-replace-localhost TARGET_DOMAIN=$(TARGET_DOMAIN)
	@$(MAKE) revert-siteurl TARGET_DOMAIN=$(TARGET_DOMAIN)
	@$(MAKE) export-db
	@read -p "Enter commit message: " msg; \
	git add .; \
	git commit -m "$$msg"; \
	git push origin dev
	@echo "Code and DB dump have been committed and pushed successfully."

# 7. Pull code from remote
pull:
	@git pull origin dev
	@echo "Code has been pulled successfully."

# 8. Clean: remove the image
clean:
	@docker rmi -f $(shell docker images -q australiav-wordpress)
	@echo "Removed the image."


# 9. Replace localhost:{port} with dynamic domain in DB (MySQL 5.7-safe)
safe-replace-localhost:
	@echo "🧼 Replacing all localhost variants safely using wp-cli..."
	@$(DOCKER_COMPOSE) exec australiav_wordpress wp search-replace 'http://localhost/australiav.org' '$(TARGET_DOMAIN)' --allow-root --all-tables --precise --recurse-objects --skip-columns=guid
	@$(DOCKER_COMPOSE) exec australiav_wordpress wp search-replace 'http://localhost:6060' '$(TARGET_DOMAIN)' --allow-root --all-tables --precise --recurse-objects --skip-columns=guid
	@$(DOCKER_COMPOSE) exec australiav_wordpress wp search-replace 'http://localhost' '$(TARGET_DOMAIN)' --allow-root --all-tables --precise --recurse-objects --skip-columns=guid
	@$(DOCKER_COMPOSE) exec australiav_wordpress wp search-replace 'https://localhost' '$(TARGET_DOMAIN)' --allow-root --all-tables --precise --recurse-objects --skip-columns=guid
	@$(DOCKER_COMPOSE) exec australiav_wordpress wp cache flush --allow-root
	@echo "✅ All localhost URLs have been safely replaced with $(TARGET_DOMAIN)"


# 10. Help: displays available commands
help:
	@echo "Available commands:"
	@echo "  make pull              - Pull code from remote"
	@echo "  make setup             - Setup local environment"
	@echo "  make push              - Export DB, then commit & push (with updated URLs)"
	@echo "  make stop              - Stop local environment"
	@echo "  make clean             - Remove the image"
	@echo "  make update-siteurl    - Update siteurl and home to http://localhost:6060"
	@echo "  make revert-siteurl    - Revert siteurl and home to \$$(TARGET_DOMAIN)"
	@echo "  make safe-replace-localhost - Safely replace all localhost URLs using wp-cli (serialization-aware)"
	@echo "  make help              - Display available commands"

# 11. Default: displays help
.DEFAULT_GOAL := help
