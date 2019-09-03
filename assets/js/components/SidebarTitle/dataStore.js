import {registerStore} from '@wordpress/data'

// This is the reducer
function reducer(state = 0, action) {

    switch (action.type) {
        case 'INCREMENT':
            return state + 1;
            break;
        case 'DECREMENT':
            return state - 1;
            break;
        default:
            return state;

    }
}

// These are some selectors
function getCount(state) {
    return state;
}


// These are the actions
function increment() {
    return {
        type: 'INCREMENT',
    };
}

function decrement() {
    return {
        type: 'DECREMENT',
    };
}

registerStore('core/SidebarTitle', {
    reducer: reducer,
    selectors: {getCount},
    actions: {increment, decrement}
});
