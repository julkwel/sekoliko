/**
 * Toggle fullscreen of page
 *
 * @param {string} id | the id will to toggle
 */
export default function openFullscreen(id)
{
    let element = document.getElementById('element');

    if (element && !document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) { /* Firefox */
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) { /* IE/Edge */
            element.msRequestFullscreen();
        }
    } else {
        alert('Fullscreen not available on this browser !')
    }
}
