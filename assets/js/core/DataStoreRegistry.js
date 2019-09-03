import {createRegistry} from "./Registry";

export default function DataStoreRegistry() {
    let registry = createRegistry({});

    /**
     *
     * @param {String} DataStoreName
     * @param {Object} DataStoreOptions
     */
    function registerDataStore(DataStoreName, DataStoreOptions) {
        registry.register(DataStoreName, DataStoreOptions)
    }

    /**
     *
     * @param DataStoreName
     * @returns {undefined|*}
     */
    function getDataStore(DataStoreName) {
        return registry.get(DataStoreName)
    }

    /**
     *
     * @param {String | String[]} DataStoreNames
     */
    function unregisterDataStore(DataStoreNames) {
        registry.unregister(DataStoreNames)
    }

    return {
        registerDataStore,
        getDataStore,
        unregisterDataStore,
    }
}