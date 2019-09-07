import {registerComponent} from "../../core/ThemosisExtendedAdmin";

export const FormPage = () => {
    return (<div className="admin-form__page"></div>)
}

registerComponent('themosis.fields.formpage', {
    renderProp: FormPage
})