import apiFetch from "@wordpress/api-fetch";
import {merge} from 'lodash'

const CsrfMiddleware = (options, next) => {
    let $tokenMetaEl = document.querySelector('meta[name="csrf-token"]')

    // If token element is present.
    if ($tokenMetaEl) {

        // Add XSRF Header to request
        options = merge(options, {
            headers: {
                'X-CSRF-TOKEN': $tokenMetaEl.getAttribute('content'),
            }
        })
    }

    return next(options)
}

apiFetch.use(CsrfMiddleware)

export {
    apiFetch
};