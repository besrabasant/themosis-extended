import {getDataTableRegistry} from "../ThemosisExtendedAdmin";
import {upperFirst, camelCase} from "lodash"

export const useTableColumnComponent = (tableID, columnKey) => {
    /** @type {DataTableRegistry} */
    let TableRegistry = getDataTableRegistry()

    /** @type {TableRenderer} */
    let TableRenderer = TableRegistry.getTableRenderer(tableID)

    let columnRendererKey = `column${upperFirst(camelCase(columnKey))}`

    return (TableRenderer.hasOwnProperty(columnRendererKey)) ? TableRenderer[columnRendererKey] : TableRenderer.columnDefault
}

export const useTableExtraContent = (tableId) => {
    /** @type {DataTableRegistry} */
    let TableRegistry = getDataTableRegistry()

    /** @type {TableRenderer} */
    let TableRenderer = TableRegistry.getTableRenderer(tableId)

    return TableRenderer.hasOwnProperty('extraContent') ? TableRenderer['extraContent'] : null
}