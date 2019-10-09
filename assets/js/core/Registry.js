import {castArray, omit} from 'lodash'

/**
 * Creates a registry.
 *
 * TODO: Add support for hook functions.
 *
 * @param {*} initialState
 * @returns {{get: function, unregister: function, register: function}}
 */
export function createRegistry(initialState) {
    let registry = initialState || {}

    /**
     *
     * @param {string} key
     * @param {*} value
     */
    function register(key, value) {
        registry[key] = value
    }

    /**
     *
     * @param {String | String[]} keys
     */
    function unregister(keys) {
        registry = omit(registry, castArray(keys))
    }

    /**
     *
     * @param String key
     * @returns {undefined|*}
     */
    function get(key) {
        if (registry.hasOwnProperty(key)) {
            return registry[key];
        }

        return undefined
    }

    function getAll() {
        return registry
    }

    return {
        register,
        unregister,
        get,
        getAll,
    }
}