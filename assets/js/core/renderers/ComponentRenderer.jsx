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