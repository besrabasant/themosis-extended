import {Component} from 'react'
import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {renderFieldGroups} from "./renderFieldGroups";
import {Csrf} from "../Form/Csrf";
import {Nonce} from "../Form/Nonce";

/**
 * @param {FormConfig} formConfig
 * @returns {Component}
 * @constructor
 */
export const AdminForm = ({formConfig}) => {
    let {class: formClass, novalidate: noValidate, ...formProps} = formConfig.attributes

    // console.log(formConfig)

    return (
        <form className={formClass} noValidate={noValidate} {...formProps}>
            <Nonce formConfig={formConfig}/>
            <Csrf formConfig={formConfig}/>
            {renderFieldGroups(formConfig.groups, formConfig.fields)}
        </form>
    )
}

registerComponent('themosis.core.adminform', {
    renderProp: AdminForm
})
