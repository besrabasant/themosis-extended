import {map} from "lodash"
import {useTableColumnComponent} from "../../core/hooks";

const TableRowsEmpty = ({attributes, columns}) => {
    return (
        <tr className="table__row table__row--empty">
            <td className="table__td" colSpan={columns.length}>
                {attributes.empty_records}
            </td>
        </tr>
    )
}

const TableRowsData = ({attributes, rows, columns}) => {
    return map(rows, row => (
        <tr key={`table-row-${row.id}`} className={`table__row table__row--${row.id}`}>
            {map(columns, (columnName, columnKey) => {

                let TableColumnRenderer = useTableColumnComponent(attributes.id, columnKey)

                return (
                    <td key={`table-td-${columnKey}-${row.id}`}
                        className={`table__td table__td--${columnKey} table__column table__column--${columnKey}`}>
                        {TableColumnRenderer(row, columnKey)}
                    </td>
                )
            })}
        </tr>
    ))
}

export const TableBody = ({attributes, columns, rows}) => {
    return (
        <tbody className={"table__body"}>
        {
            rows.length ?
                <TableRowsData attributes={attributes} rows={rows} columns={columns}/>
                :
                <TableRowsEmpty attributes={attributes} columns={columns}/>
        }
        </tbody>
    )
}