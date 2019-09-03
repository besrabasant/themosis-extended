import ComponentRenderer from "./ComponentRenderer";
import {render} from "@wordpress/element"
import {__FORM_REACT_ROOT__} from "../Constants";
import {Component} from 'react'
import {dataParser} from "../utils";
import {createComponent} from "../component";
import {AdminPageContainer} from "../components";

export class AdminFormRenderer extends ComponentRenderer {
    constructor() {
        super()

        /**
         * @type {HTMLElement}
         */
        this.RendererRoot = document.getElementById(__FORM_REACT_ROOT__)
    }

    render() {
        if (this.RendererRoot) {
            /**
             * @type {Component}
             */
            let FormComponent = createComponent('themosis.core.adminform')
            let formConfig = dataParser(this.RendererRoot.innerHTML)

            render(
                <AdminPageContainer>
                    <FormComponent formConfig={formConfig}/>
                </AdminPageContainer>
                , this.RendererRoot)
        }
    }
}