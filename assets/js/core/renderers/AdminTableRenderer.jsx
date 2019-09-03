import ComponentRenderer from "./ComponentRenderer";
import {render} from "@wordpress/element"
import {__TABLE_REACT_ROOT__} from "../Constants";
import {Component} from 'react'
import {createComponent} from "../component";
import {AdminPageContainer} from "../components";

export class AdminTableRenderer extends ComponentRenderer {
    constructor() {
        super()

        /**
         * @type {HTMLElement}
         */
        this.RendererRoot = document.getElementById(__TABLE_REACT_ROOT__)
    }

    render() {
        if (this.RendererRoot) {
            /**
             * @type {Component}
             */
            let TableComponent = createComponent('themosis.core.admintable')

            render(
                <AdminPageContainer>
                    <TableComponent/>
                </AdminPageContainer>
                , this.RendererRoot)
        }
    }
}