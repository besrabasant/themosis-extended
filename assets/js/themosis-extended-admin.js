/* global addLoadEvent */

import ThemosisExtendedAdmin  from "./core/ThemosisExtendedAdmin"

import './components'

window.ThemosisExtendedAdmin = ThemosisExtendedAdmin

function initThemosisExtendAdmin() {
    ThemosisExtendedAdmin.init(this)
}

addLoadEvent(initThemosisExtendAdmin.bind(window))



