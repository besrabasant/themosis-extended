import {createRegistry} from "../Registry";


export default function DataTableRegistry() {
    let registry = createRegistry({})

    function registerTableRenderer(TableID, TableRenderer) {
        registry.register(TableID, TableRenderer)
    }

    /**
     *
     * @param {string} TableID
     * @returns {*}
     */
    function getTableRenderer(TableID) {
        return registry.get(TableID)
    }

    /**
     *
     * @param {String | String[]} TableIds
     *
     * @returns {void}
     */
    function unregisterTableRenderer(TableIds) {
        registry.unregister(TableIds)
    }

    function getAllTables() {
        return registry.getAll()
    }

    return {
        registerTableRenderer,
        getTableRenderer,
        getAllTables,
        unregisterTableRenderer
    }
}