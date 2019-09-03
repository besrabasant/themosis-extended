import {__SIDEBAR_REACT_ROOT__, __HEADER_REACT_ROOT__} from "../Constants";

/**
 * Component Renderer abstract class.
 */
class ComponentRenderer {
    constructor() {
        if (new.target === ComponentRenderer) {
            throw new TypeError('Call to Abstract class "ComponentRenderer"!');
        }
    }

    render() {
        throw new TypeError('Call to abstract method "render"!');
    }
}

export default ComponentRenderer