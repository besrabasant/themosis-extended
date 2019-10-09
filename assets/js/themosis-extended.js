import './utils/dd'
import {apiFetch} from "./utils/apiFetch";
import {REST_REQUEST} from "./utils/rest";
import {createReducer} from "./core/utils";

export const ThemosisExtended = {
    apiFetch,
    REST_REQUEST,
    createReducer,
}

window.ThemosisExtended = ThemosisExtended