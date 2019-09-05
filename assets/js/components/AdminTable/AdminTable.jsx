import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {TableHead} from "./TableHead";
import {TableBody} from "./TableBody";

export const AdminTable = ({tableData}) => {
    return (
        <table id={tableData.attributes.id} className={`table table-bordered table--${tableData.attributes.id}`}>
            <TableHead attributes={tableData.attributes} columns={tableData.columns}/>
            <TableBody attributes={tableData.attributes} columns={tableData.columns} rows={tableData.rows}/>
        </table>
    )
}

registerComponent('themosis.core.admintable', {
    renderProp: AdminTable
})