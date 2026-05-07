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

    if (!localStorage.getItem('dis_internships')) {
      const internships = [
        {
          id: 'int_1',
          companyId: 'usr_hr1',
          companyName: 'TechCorp Solutions',
          title: 'Frontend Developer Intern',
          category: 'Web Development',
          location: 'San Francisco, CA (Hybrid)',
          duration: '3 Months',
          stipend: '$1,200 / month',
          positions: 3,
          deadline: '2026-09-30',
          description: 'Join our dynamic frontend team building next-generation web platforms using React, Tailwind CSS, and HTML5/JS.',
          requirements: 'Basic proficiency in HTML, CSS, JavaScript. Knowledge of Git and dynamic layout design.',
          status: 'active',
          postedAt: '2026-07-01'
        },
        {
          id: 'int_2',
          companyId: 'usr_hr1',
          companyName: 'TechCorp Solutions',
          title: 'AI & Data Science Intern',
          category: 'Data Science',
          location: 'Remote',
          duration: '6 Months',
          stipend: '$1,500 / month',
          positions: 2,
          deadline: '2026-10-15',
          description: 'Assist in building predictive models and processing datasets for modern software engines.',
          requirements: 'Python, SQL, basic understanding of Machine Learning principles.',
          status: 'active',
          postedAt: '2026-07-10'
        }
      ];
      localStorage.setItem('dis_internships', JSON.stringify(internships));
    }

    if (!localStorage.getItem('dis_applications')) {
      const apps = [
        {
          id: 'app_1',
          internshipId: 'int_1',
          studentId: 'usr_std1',
          studentName: 'Ahmed Hassan',
          studentEmail: 'ahmed@student.com',
          companyId: 'usr_hr1',
          cvName: 'ahmed_hassan_cv.pdf',
          status: 'Shortlisted',
          appliedAt: '2026-08-01',
          supervisorId: 'usr_sup1',
          completionVerified: false,
          interview: {
            date: '2026-08-20',
            time: '14:00',
            mode: 'Onsite',
            address: 'TechCorp Solutions HQ, Suite 400, Silicon Avenue, San Francisco',
            scheduledAt: '2026-08-05'
          }
        }
      ];
      localStorage.setItem('dis_applications', JSON.stringify(apps));
    }

    if (!localStorage.getItem('dis_tasks')) {
      const tasks = [
        {
          id: 'tsk_1',
          studentId: 'usr_std1',
          supervisorId: 'usr_sup1',
          companyId: 'usr_hr1',
          title: 'Implement Responsive Navigation Bar',
          description: 'Build a fully accessible responsive navbar with mobile drawer and theme toggle.',
          deadline: '2026-08-25',
          status: 'Pending',
          assignedAt: '2026-08-10'
        }
      ];
      localStorage.setItem('dis_tasks', JSON.stringify(tasks));
    }

    if (!localStorage.getItem('dis_progress_reports')) {
      const reports = [
        {
          id: 'rep_1',
          studentId: 'usr_std1',
          supervisorId: 'usr_sup1',
          weekNumber: 1,
          summary: 'Completed onboarding, set up environment, and reviewed codebase architecture.',
          achievements: 'Configured local development server and resolved 2 layout UI issues.',
          attachmentName: 'week1_progress_doc.pdf',
          submittedAt: '2026-08-11',
          feedback: {
            rating: 5,
            comment: 'Excellent initiative! Great job setting up the development setup quickly.',
            givenAt: '2026-08-12'
          }
        }
      ];
      localStorage.setItem('dis_progress_reports', JSON.stringify(reports));
    }

    if (!localStorage.getItem('dis_notifications')) {
      const notifications = [
        {
          id: 'notif_1',
          userId: 'usr_std1',
          title: 'Application Shortlisted!',
          message: 'TechCorp Solutions shortlisted your application for Frontend Developer Intern.',