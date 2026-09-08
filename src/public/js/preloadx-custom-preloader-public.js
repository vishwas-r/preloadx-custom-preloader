(function() {
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {
        var preloader = document.querySelector('.pxpreloader');
        if (!preloader) return;

        // Settings localized from PHP
        var settings = window.preloadxSettings || {
            exit_animation: 'fade',
            min_load_time: 500,
            close_button: '0',
            selected: 'none'
        };

        var minTime = parseInt(settings.min_load_time, 10);
        var startTime = Date.now();
        var isLoaded = false;
        var progressInterval;
        var progressBar = document.getElementById('px-progress-bar');
        var progressText = document.getElementById('px-progress-text');
        var closeBtn = document.getElementById('preloadx-close-btn');

        // Progress Bar Logic (Fake progress up to 90%)
        if (settings.selected === 'progress-bar' && progressBar && progressText) {
            var currentProgress = 0;
            progressInterval = setInterval(function() {
                currentProgress += Math.random() * 10;
                if (currentProgress > 90) {
                    currentProgress = 90;
                    clearInterval(progressInterval);
                }
                progressBar.style.width = currentProgress + '%';
                progressText.innerText = Math.floor(currentProgress) + '%';
            }, 200);
        }

        // Close Button Logic
        if (settings.close_button === '1' && closeBtn) {
            setTimeout(function() {
                if (!isLoaded) {
                    closeBtn.style.display = 'block';
                }
            }, 5000); // Show after 5 seconds if not loaded

            closeBtn.addEventListener('click', hidePreloader);
        }

        function hidePreloader() {
            if (isLoaded) return;
            isLoaded = true;

            var timeElapsed = Date.now() - startTime;
            var remainingTime = minTime - timeElapsed;
            if (remainingTime < 0) remainingTime = 0;

            setTimeout(function() {
                // If progress bar, jump to 100% before hiding
                if (settings.selected === 'progress-bar' && progressBar && progressText) {
                    clearInterval(progressInterval);
                    progressBar.style.width = '100%';
                    progressText.innerText = '100%';
                    
                    setTimeout(executeExitAnimation, 300); // wait for 100% animation to finish
                } else {
                    executeExitAnimation();
                }
            }, remainingTime);
        }

        function executeExitAnimation() {
            if (closeBtn) closeBtn.style.display = 'none';

            var animationClass = 'exit-' + settings.exit_animation;
            preloader.classList.add(animationClass);

            // Remove from DOM after animation completes (850ms)
            setTimeout(function() {
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 850);
        }

        window.addEventListener('load', hidePreloader);
    });

})();
