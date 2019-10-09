export const createReducer = (handlers, initialState = {}) => {
    return (state = initialState, action) => {
        if (handlers.hasOwnProperty(action.type)) {
            return handlers[action.type](state, action)
        } else {
            return state
        }
    }
}

export const createSwitchCase = (handlers, defaultCase = null) => {
    return (caseCondtion) => {
        if (handlers.hasOwnProperty(caseCondtion)) {
            return handlers[caseCondtion]
        } else {
            return defaultCase
        }
    }
}