import {useTableExtraContent} from "../../core/hooks";
import {AdminTableContext} from "../../core/contexts";

export const TableExtraContentComponent = ({row, colSpan, attributes}) => {

    let TableExtraContent = useTableExtraContent(attributes.id)

    return TableExtraContent &&
        (<AdminTableContext.Consumer>
            {
                ({State}) => {
                    return (State.showExtraContent === row.id) ? (
                        <tr className={`table__row table__row--extracontent`}>
                            <td className={`table__td table__td--extracontent`} colSpan={colSpan}>
                                {TableExtraContent(row)}
                            </td>
                        </tr>
                    ) : null
                }
            }
        </AdminTableContext.Consumer>)

}