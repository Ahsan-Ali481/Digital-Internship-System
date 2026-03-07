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
          role: 'admin',
          name: 'System Administrator',
          email: 'admin@dis.com',
          password: 'password123',
          status: 'approved',
          avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80',
          createdAt: '2026-01-01'