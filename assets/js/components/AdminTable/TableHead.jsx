import {map, last, keys} from "lodash"
import classNames from "classnames"

export const TableHead = ({attributes, columns}) => {
    let lastColumnIndex = last(keys(columns))

    return (
        <thead className="table__head">
        <tr className="table__row">
            {map(columns, (columnName, columnKey) => {

                let tableHeadClasses = classNames('table__th table__column', `table__column--${columnKey}`, {
                    'table__column--last': (columnKey === lastColumnIndex)
                })

                return (
                    <th key={columnKey} className={tableHeadClasses} dangerouslySetInnerHTML={{__html: columnName}}/>
                )
            })}
        </tr>
        </thead>
    )
}