import {Component} from 'react'
import classNames from "classnames"
import {createRef} from "@wordpress/element";
import {renderFieldGroups} from "./renderFieldGroups";
import {Csrf} from "../Form/Csrf";
import {Nonce} from "../Form/Nonce";
import {withFormPages, FormPageNavs} from "./withFormPages"
import {kebabCase, map} from "lodash";
import {AdminFormContext} from "../../core/contexts";

/**
 * @param {FormConfig} formConfig
 * @returns {Component}
 * @constructor
 */
export const AdminForm = ({formConfig}) => {
    let {class: formClass, novalidate: noValidate, ...formProps} = formConfig.attributes

    let formPagesWithRefs = map(formConfig.pages, formPage => ({item: formPage, ref: createRef()}))

    formClass = classNames(formClass, `form--${kebabCase(formConfig.name)}`, {
        'form--paged': (formConfig.pages.length > 0)
    })

    return (
        <AdminFormContext.Provider value={{}}>
            <form className={formClass} noValidate={noValidate} {...formProps}>
                <Nonce formConfig={formConfig}/>
                <Csrf formConfig={formConfig}/>
                {
                    formConfig.pages.length ?
                        withFormPages(formPagesWithRefs, formConfig.groups, formConfig.fields)(renderFieldGroups)
                        :
                        renderFieldGroups(formConfig.groups, formConfig.fields)
                }
                {
                    formConfig.pages.length ? (<FormPageNavs pageRefs={formPagesWithRefs}/>) : null
                }
            </form>
        </AdminFormContext.Provider>
    )
}


