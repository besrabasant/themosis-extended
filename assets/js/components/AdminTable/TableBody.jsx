import {map, last, keys} from "lodash"
import classNames from "classnames"
import {useTableColumnComponent} from "../../core/hooks";
import {TableExtraContentComponent as TableExtraContent} from "./TableExtraContent";
import {Fragment} from '@wordpress/element'

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
    let lastColumnIndex = last(keys(columns))

    return map(rows, row => (
        <Fragment key={`table-row-${row.id}`}>
            <tr className={`table__row table__row--${row.id}`}>
                {map(columns, (columnName, columnKey) => {

                    let TableColumnRenderer = useTableColumnComponent(attributes.id, columnKey)
                    let tableDataClasses = classNames('table__td table__column',
                        `table__td--${columnKey} table__column--${columnKey}`,
                        {
                            'table__column--last': (columnKey === lastColumnIndex)
                        })

                    return (
                        <td key={`table-td-${columnKey}-${row.id}`}
                            className={tableDataClasses}>
                            {TableColumnRenderer(row, columnKey)}
                        </td>
                    )
                })}
            </tr>
            <TableExtraContent colSpan={columns.length} attributes={attributes} row={row}/>
        </Fragment>
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