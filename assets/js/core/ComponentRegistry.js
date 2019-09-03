import {createRegistry} from "./Registry"
import {Component} from 'react'

/**
 * @typedef ComponentAttributes
 */

/**
 * @typedef {Object} ComponentOptions
 * @property {ComponentAttributes} attributes - optional
 * @property {Component} renderProp - required
 */

/**
 * @typedef {Object} ComponentRegistry
 * @property {Function} registerComponent
 * @property {Function} getComponent
 * @property {Function} getRenderProp
 * @property {Function} getAttributes
 * @property {Function} unregisterComponents
 */

/**
 * @returns ComponentRegistry
 * @constructor
 */
export default function ComponentRegistry() {
    let registry = createRegistry({});

    /**
     * Registers a Component to the ComponentRegistry.
     *
     * @param {String} ComponentName
     * @param {ComponentOptions} ComponentOptions
     */
    function registerComponent(ComponentName, ComponentOptions) {
        registry.register(ComponentName, ComponentOptions)
    }

    /**
     * Returns the Commponent Options of a Component from Component Registry or undefined if not found.
     *
     * @param {String} ComponentName
     * @returns {undefined|ComponentOptions}
     *
     */
    function getComponent(ComponentName) {
        return registry.get(ComponentName)
    }

    /**
     * Returns the Component renderProp property
     *
     * @param {String} ComponentName
     * @returns {Component | undefined}
     */
    function getRenderProp(ComponentName) {
        let component = getComponent(ComponentName)

        if (component) {
            return component.renderProp
        }

        return undefined
    }

    /**
     * Returns Component attributes of a Component.
     *
     * @param {String} ComponentName
     * @return { ComponentAttributes | undefined }
     */
    function getAttributes(ComponentName) {
        let component = getComponent(ComponentName)

        if (component != undefined && component.hasOwnProperty('attributes')) {
            return component.attributes
        }

        return undefined
    }

    /**
     * Unregisters Component(s) from the ComponentRegistry.
     *
     * @param {String | String[]} ComponentNames
     * @returns {void}
     */
    function unregisterComponents(ComponentNames) {
        registry.unregister(ComponentNames)
    }

    return {
        registerComponent,
        getComponent,
        getRenderProp,
        getAttributes,
        unregisterComponents,
    }
}