export class NoticeAlerts {
    constructor() {
        this.$alerts = document.querySelectorAll('.alert')
    }

    init() {

        if (!this.$alerts.length) {
            return
        }

        this.$alerts.forEach(this.animateInAlert.bind(this))
    }

    /**
     * @param {HTMLElement} $alert
     */
    animateInAlert($alert) {
        $alert.addEventListener('animationend', this.alertAnimationEnd.bind(this))
        $alert.classList.add('alert--animate-in')
    }

    /**
     * @param {AnimationEvent} animationEvent
     */
    alertAnimationEnd(animationEvent) {
        this[animationEvent.animationName](animationEvent.target)
    }

    /**
     * @param {HTMLElement $alert
     */
    adminNoticeAnimateIn($alert) {
        $alert.classList.remove('alert--animate-in')
        $alert.classList.add('alert--animated-in')
    }
}

