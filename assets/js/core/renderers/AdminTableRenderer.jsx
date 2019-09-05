import ComponentRenderer from "./ComponentRenderer";
import {render} from "@wordpress/element"
import {__TABLE_REACT_ROOT__} from "../Constants";
import {Component} from 'react'
import {createComponent} from "../component";
import {AdminPageContainer} from "../components";
import {dataParser} from "../utils";

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
            let tableData = dataParser(this.RendererRoot.innerHTML)

            render(
                <AdminPageContainer>
                    <TableComponent tableData={tableData}/>
                </AdminPageContainer>
                , this.RendererRoot)
        }
    }
}