import { DoubleImageEffect } from './doubleImageEffect.js';

[...document.querySelectorAll('.double')].forEach(el => new DoubleImageEffect(el));

// Preload images
imagesLoaded(document.querySelectorAll('.double__img'), {background: true}, () => {
    // Remove loader (loading class)
    document.body.classList.remove('loading');
});