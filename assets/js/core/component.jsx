import ThemosisExtendedAdmin from "./ThemosisExtendedAdmin"
import {merge, kebabCase} from "lodash"
import React, {ReactElement, StatelessComponent} from 'react'

/**
 * @typedef {Object} RenderConfig
 * @property {ComponentAttributes} attributes
 * @property {String} name
 * @property {RenderConfig[]} content
 */

/**
 * @typedef {Object} DefaultProps
 * @property {ComponentAttributes} attributes
 * @property {null| ReactElement[]} children
 */

/**
 * @type {DefaultProps}
 */
let defaultProps = {
    attributes: {},
    children: null
}

/**
 * Creates component from Component Registry.
 *
 * @param {String} componentName
 * @param {ComponentAttributes} componentAttributes
 * @param {RenderConfig[]} componentContent
 *
 * @returns {null| StatelessComponent | Component}
 */
export function createComponent(componentName, componentAttributes = {}, componentContent = []) {
    /**
     * @type {ComponentRegistry}
     */
    let ComponentRegistry = ThemosisExtendedAdmin.getComponentRegistry()

    /**
     * @type {StatelessComponent}
     */
    let RegisteredComponent = ComponentRegistry.getRenderProp(componentName)

    if (RegisteredComponent === undefined) {
        return null
    }

    /**
     * @type {ComponentAttributes}
     */
    let RegisteredAttributes = ComponentRegistry.getAttributes(componentName)

    /**
     *
     * @type {ComponentAttributes}
     */
    let MergedAttributes = {...RegisteredAttributes, ...componentAttributes}

    let componentProps = {attributes: MergedAttributes}

    if (componentContent) {
        componentProps.children = createComponentsFromConfig(componentContent)
    }

    RegisteredComponent.defaultProps = merge(defaultProps, componentProps)

    return RegisteredComponent
}

/**
 * Creates Component tree from a render config.
 *
 * @param {RenderConfig[]} RenderConfig
 * @returns {ReactElement[]}
 */
export function createComponentsFromConfig(RenderConfig) {
    return RenderConfig.map((componentConfig, key) => {
        let componentAttributes = componentConfig.attributes || {},
            componentContent = componentConfig.content || undefined,
            RenderedComponent = createComponent(componentConfig.name, componentAttributes)

        return (<RenderedComponent key={`${kebabCase(componentConfig.name)}-${key}`}/>)
    })
}