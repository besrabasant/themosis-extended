/* global addLoadEvent */

import './utils/dd'
import * as ThemosisExtendedAdminComponents from "./components";
import './components/register'
import './components/datastores'
import ThemosisExtendedAdmin from "./core/ThemosisExtendedAdmin"

window.ThemosisExtendedAdminComponents = ThemosisExtendedAdminComponents

window.ThemosisExtendedAdmin = ThemosisExtendedAdmin

function initThemosisExtendAdmin() {
    ThemosisExtendedAdmin.init(this)
}

addLoadEvent(initThemosisExtendAdmin.bind(window))