import ComponentRegistry from './registry/ComponentRegistry'
import DataTableRegistry from "./registry/TableRegistry";
import {removeBodyLoadingClass} from "./utils"
import {AdminFormRenderer, AdminTableRenderer} from './renderers'
import {NoticeAlerts} from "../components/NoticeAlerts";

/**
 * @type {ComponentRegistry}
 */
let componentRegistry = new ComponentRegistry()
let dataTableRegistry = new DataTableRegistry()

// Renderers
let formRenderer = new AdminFormRenderer()
let tableRenderer = new AdminTableRenderer()
let noticeAlerts = new NoticeAlerts()


// TODO: DataStore Registry marked for removal
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
}

export default ThemosisExtendedAdmin

export const init = ThemosisExtendedAdmin.init

export const registerComponent = ThemosisExtendedAdmin.registerComponent

export const getComponentRegistry = ThemosisExtendedAdmin.getComponentRegistry

export const registerTable = ThemosisExtendedAdmin.registerTable

export const getDataTableRegistry = ThemosisExtendedAdmin.getDataTableRegistry
