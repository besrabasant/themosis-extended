import {registerComponent} from "../../core/ThemosisExtendedAdmin";

export const AdminTable = () => {
    return (<div>Table</div>)
}

registerComponent('themosis.core.admintable', {
    renderProp: AdminTable
})