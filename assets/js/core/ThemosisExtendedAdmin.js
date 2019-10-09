import ComponentRegistry from './registry/ComponentRegistry'
import DataTableRegistry from "./registry/TableRegistry";
import {removeBodyLoadingClass, createReducer, dataParser, createSwitchCase} from "./utils"
import {AdminFormRenderer, AdminTableRenderer} from './renderers'
import {NoticeAlerts} from "../components/NoticeAlerts"
import {createComponent, createComponentsFromConfig} from './component'
import { apiFetch } from "../utils/apiFetch";
import {REST_REQUEST} from "../utils/rest";

/**
 * @type {ComponentRegistry}
 */
let componentRegistry = new ComponentRegistry()
let dataTableRegistry = new DataTableRegistry()

// Renderers
let formRenderer = new AdminFormRenderer()
let tableRenderer = new AdminTableRenderer()
let noticeAlerts = new NoticeAlerts()

class ThemosisExtendedAdmin {
    /**
     *
     * @param {Window} window
     */
    static init(window) {
        formRenderer.render()
        tableRenderer.render()

        removeBodyLoadingClass(() => {
            noticeAlerts.init()
        });
    }

    /**
     *
     * @param {String} ComponentName
     * @param {ComponentOptions} ComponentOptions
     */
    static registerComponent(ComponentName, ComponentOptions) {
        componentRegistry.registerComponent(ComponentName, ComponentOptions)
    }

    /**
     * @returns {ComponentRegistry}
     */
    static getComponentRegistry() {
        return componentRegistry
    }

    /**
     *
     * @param {string} TableID
     * @param {*} TableRenderer
     */
    static registerTable(TableID, TableRenderer) {
        dataTableRegistry.registerTableRenderer(TableID, TableRenderer)
    }

    /**
     *
     * @returns {DataTableRegistry}
     */
    static getDataTableRegistry() {
        return dataTableRegistry
    }

    /**
     * @returns {createComponent}
     */
    static get createComponent() {
        return createComponent
    }

    /**
     * @returns {createComponentsFromConfig}
     */
    static get createComponentsFromConfig() {
        return createComponentsFromConfig
    }

    /**
     * Expost Wp Core apiFetch.
     *
     * @returns {apiFetch}
     */
    static get apiFetch() {
        return apiFetch
    }

    /**
     * @returns {{DELETE, POST, GET, OPTIONS, PUT}}
     * @constructor
     */
    static get REST_REQUEST() {
        return REST_REQUEST
    }

    /**
     * @returns {createReducer}
     */
    static get createReducer() {
        return createReducer
    }

    /**
     * @returns {dataParser}
     */
    static get dataParser() {
        return dataParser
    }

    /**
     * @returns {createSwitchCase}
     */
    static get createSwitchCase() {
        return createSwitchCase
    }
}


export default ThemosisExtendedAdmin

export const init = ThemosisExtendedAdmin.init

export const registerComponent = ThemosisExtendedAdmin.registerComponent

export const getComponentRegistry = ThemosisExtendedAdmin.getComponentRegistry

export const registerTable = ThemosisExtendedAdmin.registerTable

export const getDataTableRegistry = ThemosisExtendedAdmin.getDataTableRegistry
