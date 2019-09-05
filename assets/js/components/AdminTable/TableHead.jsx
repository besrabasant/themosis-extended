import {map} from "lodash"

export const TableHead = ({attributes, columns}) => {
    return (
        <thead className="table__head">
        <tr className="table__row">
            {map(columns, (columnName, columnKey) => (
                <th key={columnKey} className={`table__th table__column table__column--${columnKey}`}>
                    {columnName}
                </th>
            ))}
        </tr>
        </thead>
    )
}