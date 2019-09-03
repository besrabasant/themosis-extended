/**
 * @param {Function} callback
 */
export const removeBodyLoadingClass = (callback) => {
    document.body.classList.remove('themosis-extended-admin-page--loading');

    if (callback && callback instanceof Function) {
        callback()
    }
}