import { Dropdown, Modal, Tooltip, Collapse, Alert } from 'bootstrap';

/**
 * Explicitly initialize all Bootstrap interactive components.
 * Importing individual classes (instead of `* as bootstrap`) and calling
 * getOrCreateInstance ensures data-bs-toggle attributes work reliably
 * in both dev (HMR) and production builds.
 */
document.addEventListener('DOMContentLoaded', () => {

    // Dropdowns
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
        Dropdown.getOrCreateInstance(el);
    });

    // Modals
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(el => {
        // Modals are triggered by their toggle buttons; no pre-init needed,
        // but we import Modal so it's included in the bundle.
    });

    // Collapse (navbar toggler, accordions)
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(el => {
        Collapse.getOrCreateInstance(el, { toggle: false });
    });

    // Tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        Tooltip.getOrCreateInstance(el);
    });

    // Auto-dismiss alerts
    document.querySelectorAll('.alert-dismissible').forEach(el => {
        Alert.getOrCreateInstance(el);
    });

});
