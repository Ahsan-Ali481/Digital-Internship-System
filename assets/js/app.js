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
        },
        {
          id: 'usr_std1',
          role: 'student',
          name: 'Ahmed Hassan',
          email: 'ahmed@student.com',
          password: 'password123',
          university: 'National University of Sciences & Technology',
          major: 'Software Engineering',
          gradYear: '2027',
          phone: '+92 300 1234567',
          resumeUrl: 'ahmed_hassan_resume.pdf',
          status: 'approved',
          avatar: 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=150&q=80',
          createdAt: '2026-02-10'
        },
        {
          id: 'usr_hr1',
          role: 'company',
          name: 'Sarah Jenkins',
          email: 'hr@techcorp.com',
          password: 'password123',
          companyName: 'TechCorp Solutions',
          industry: 'Software & Cloud Solutions',
          website: 'https://techcorp.com',
          phone: '+1 415 555 0199',
          certificateUrl: 'techcorp_inc_certificate.pdf',
          status: 'approved',
          avatar: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80',
          createdAt: '2026-01-15'
        },
        {
          id: 'usr_sup1',
          role: 'supervisor',
          name: 'Dr. Robert Chen',
          email: 'supervisor@techcorp.com',
          password: 'password123',
          companyId: 'usr_hr1',
          department: 'Engineering & AI Labs',
          phone: '+1 415 555 0188',
          status: 'approved',
          avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
          createdAt: '2026-01-20'
        }
      ];
      localStorage.setItem('dis_users', JSON.stringify(users));
    }
