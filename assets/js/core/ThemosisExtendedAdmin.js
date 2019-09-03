import ComponentRegistry from './ComponentRegistry'
import DataStoreRegistry from "./DataStoreRegistry"
import {RenderFormFields} from "./renderFormFields"
import {removeBodyLoadingClass} from "./utils"
import {AdminFormRenderer, AdminTableRenderer} from './renderers'
import {NoticeAlerts} from "../components/NoticeAlerts";

/**
 * @type {ComponentRegistry}
 */
let componentRegistry = new ComponentRegistry()
let dataStoreRegistry = new DataStoreRegistry()
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

        // RenderFormFields()

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
     * @param {String} DataStoreName
     * @param {*} DataStoreOptions
     */
    static registerDataStore(DataStoreName, DataStoreOptions) {
        dataStoreRegistry.registerDataStore(DataStoreName, DataStoreOptions)
    }

    /**
     * @returns {DataStoreRegistry}
     */
    static getDataStoreRegistry() {
        dataStoreRegistry
    }
}

export default ThemosisExtendedAdmin

export const init = ThemosisExtendedAdmin.init

export const registerComponent = ThemosisExtendedAdmin.registerComponent

export const registerDataStore = ThemosisExtendedAdmin.registerDataStore

export const getComponentRegistry = ThemosisExtendedAdmin.getComponentRegistry

export const getDataStoreRegistry = ThemosisExtendedAdmin.getDataStoreRegistry