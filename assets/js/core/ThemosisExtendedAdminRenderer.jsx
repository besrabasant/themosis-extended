import {render} from '@wordpress/element'
import {createComponentsFromConfig} from "./component";
import {dataParser} from "./utils";
import {Component} from 'react'

class ThemosisExtendedAdminRenderer {
    /**
     * @param {String | HTMLElement } RendererRoot
     * @param {Component} RendererComponent
     */
    constructor(RendererRoot, RendererComponent) {

        /**
         * @type {HTMLElement}
         */
        this.RendererRoot = (RendererRoot instanceof HTMLElement) ? RendererRoot : document.getElementById(RendererRoot)

        /**
         * @type {Component}
         */
        this.RendererComponent = RendererComponent
    }

    /**
     * @return {void}
     */
    render() {
        if (this.RendererRoot) {
            // let renderConfig = dataParser(this.RendererRoot.innerHTML)
            // let RenderComponentContents = createComponentsFromConfig(renderConfig)
            // render(<this.RendererComponent>{RenderComponentContents}</this.RendererComponent>, this.RendererRoot)
        }
    }

}

export default ThemosisExtendedAdminRenderer