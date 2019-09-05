import {getDataTableRegistry} from "../ThemosisExtendedAdmin";
import {capitalize} from "lodash"

export const useTableColumnComponent = (tableID, columnKey) => {
    /** @type {DataTableRegistry} */
    let TableRegistry = getDataTableRegistry()

    /** @type {TableRenderer} */
    let TableRenderer = TableRegistry.getTableRenderer(tableID)

    let ColumnRenderer = (TableRenderer.hasOwnProperty(`column${capitalize(columnKey)}`)) ? TableRenderer[`column${capitalize(columnKey)}`] : TableRenderer.columnDefault

    return ColumnRenderer
}