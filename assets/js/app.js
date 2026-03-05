/**
 * Digital Internship System (DIS) - Core Application Logic & State Engine
 * Handles session management, localStorage state, Dark/Light mode, notifications,
 * modals, form validation, and CSV reports generation.
 */

(function () {
  'use strict';

  // Seed Initial Sample Data if absent
  function initSeedData() {
    if (!localStorage.getItem('dis_users')) {
      const users = [
        {
          id: 'usr_admin1',