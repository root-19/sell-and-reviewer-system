<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controller/QuizController.php';

use App\Controllers\QuizController;
use App\Config\Database;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Create database connection
$db = (new Database())->connect();
$quizController = new QuizController($db);

// Define available subjects
$subjects = [
    'Organizational Management' => 'Organizational Management',
    'Marketing' => 'Marketing'
];


$questions_by_subject = [
    'Organizational Management' => [
        [
            'question' => 'Getting things done through people and delegating tasks with other people.',
            'choices' => ['A) Leader', 'B) Managers', 'C) Management', 'D) Controlling'],
            'answer' => 'C'
        ],
        [
            'question' => 'Doing the instructions right. The ability to use resources to get things done as they ought to be done.',
            'choices' => ['A) Efficiency', 'B) Effective', 'C) Planning', 'D) Management'],
            'answer' => 'B'
        ],
        [
            'question' => 'Ability to maximize output using the least amount of resources and doing things right.',
            'choices' => ['A) Efficiency', 'B) Effective', 'C) Planning', 'D) Management'],
            'answer' => 'A'
        ],
        [
            'question' => 'Individuals who carry the task of management and ensure effective and efficient use of resources.',
            'choices' => ['A) Staffing', 'B) Leaders', 'C) Management', 'D) Managers'],
            'answer' => 'D'
        ],
        [
            'question' => 'The ordinary members of an organization as opposed to its leader.',
            'choices' => ['A) Rank & File', 'B) Managers', 'C) Supervisor', 'D) Controlling'],
            'answer' => 'A'
        ],
        [
            'question' => 'Setting goals and specifying ways to attain them. It is a methodical technique of looking ahead to meet work requirements.',
            'choices' => ['A) Organizing', 'B) Staffing', 'C) Planning', 'D) CEO'],
            'answer' => 'C'
        ],
        [
            'question' => 'Assigning tasks and allocating people. Arranging parts to make it as a whole.',
            'choices' => ['A) Influencing', 'B) Organizing', 'C) Staffing', 'D) Controlling'],
            'answer' => 'B'
        ],
        [
            'question' => 'Guiding and directing the behavior of subordinates. Helping others to get the job well done.',
            'choices' => ['A) Influencing', 'B) Organizing', 'C) Staffing', 'D) Controlling'],
            'answer' => 'A'
        ],
        [
            'question' => 'Monitor and check alignment of performance to predetermined standards.',
            'choices' => ['A) Influencing', 'B) Organizing', 'C) Staffing', 'D) Controlling'],
            'answer' => 'D'
        ],
        [
            'question' => 'Deciding what type of people should be hired and finding the right people for the right job.',
            'choices' => ['A) Influencing', 'B) Organizing', 'C) Staffing', 'D) Controlling'],
            'answer' => 'C'
        ],
        [
            'question' => 'Ability to do something with a desired level of performance.',
            'choices' => ['A) Skills', 'B) Talents', 'C) Habits', 'D) Intellectuality'],
            'answer' => 'A'
        ],
        [
            'question' => 'Being able to carry out tasks with proficiency.',
            'choices' => ['A) Skills', 'B) Conceptual Skills', 'C) Technical Skillsr', 'D) Human Skills'],
            'answer' => 'C'
        ],
        [
            'question' => 'Working with people and bringing out the best in them.',
            'choices' => ['A) Skills', 'B) Conceptual Skills', 'C) Technical Skills', 'D) Human Skills'],
            'answer' => 'D'
        ],
        [
            'question' => 'Being able to see the organization as a whole. Diagnosing the cause and effect relationship in the company.',
            'choices' => ['A) Skills', 'B) Conceptual Skills', 'C) Technical Skills', 'D) Human Skills'],
            'answer' => 'B'
        ],
        [
            'question' => 'Managers handle problems and seize opportunities facing the organization.',
            'choices' => ['A) Managers', 'B) Decisional Roles', 'C) Informational Roles', 'D) Interpersonal Roles'],
            'answer' => 'B'
        ],
        [
            'question' => 'Associated with interactions with various stakeholders regarding the mission and direction of organization.',
            'choices' => ['A) Decisional Roles', 'B) Informational Roles', 'C) Managers', 'D) Interpersonal Roles'],
            'answer' => 'D'
        ],
        [
            'question' => 'Associated with tasks of obtaining and transmitting information.',
            'choices' => ['A) Managers', 'B) Decisional Roles', 'C) Informational Roles', 'D) Interpersonal Roles'],
            'answer' => 'C'
        ],
        [
            'question' => 'Whole work is to be divided into small tasks',
            'choices' => ['A) Authority and Responsibility', 'B) Division of work', 'C) Discipline', 'D) Unity and Command'],
            'answer' => 'B'
        ],
        [
            'question' => 'Superior giving enhanced order to subordinates by obligation for performance.',
            'choices' => ['A) Unity and Command', 'B) Discipline', 'C) Authority and Responsibility', 'D) Division of Work'],
            'answer' => 'C'
        ],
        [
            'question' => 'Refers to obedience, proper conduct, respect, smooth functioning and shaping of culture.',
            'choices' => ['A) Authority and Responsibility', 'B) Discipline', 'C) Division of Work', 'D) Unity and Command'],
            'answer' => 'B'
        ],
        [
            'question' => 'Each subordinates should receive orders and be accountable to one superior.',
            'choices' => ['A) Authority and Responsibility', 'B) Unity of Command', 'C) Unity of Direction', 'D) Subordination of Individual Interest'],
            'answer' => 'B'
        ],
        [
            'question' => 'All working on the same line, pursuing the same objective. To ensure unity in action, focusing on efforts.',
            'choices' => ['A) Subordination of Individual Interest', 'B) Unity of Direction', 'C) Remuneration', 'D) Unity of Command'],
            'answer' => 'B'
        ],
        [
            'question' => 'Interests of organizational goals prevails over personal interest of individuals',
            'choices' => ['A) Subordination of Individual Interest', 'B) Remuneration', 'C) Unity of Direction', 'D) The Degree of Centralization'],
            'answer' => 'A'
        ],
        [
            'question' => 'Chief motivation & influences productivity. It should be fair, reasonable, and rewarding of effort',
            'choices' => ['A) Subordination of Individual Interest', 'B) The Degree of Centralization', 'C) Remuneration', 'D) Scalar Chain'],
            'answer' => 'C'
        ],
        [
            'question' => 'Concentration of decision-making authority at the top management',
            'choices' => ['A) Scalar Chain', 'B) Order', 'C) Remuneration', 'D) The Degree of Centralization'],
            'answer' => 'D'
        ],
        [
            'question' => 'Chain of command, superiors ranging from top to lowest rank. Also called as ‘gangplank',
            'choices' => ['A) Order', 'B) Scalar Chain', 'C) The Degree of Centralization', 'D) Equity'],
            'answer' => 'B'
        ],
        [
            'question' => 'Should be acceptable and under the rules of the company',
            'choices' => ['A) Scalar Chain', 'B) Equity', 'C) Stability of Tenure of Personnel', 'D) Order'],
            'answer' => 'D'
        ],
        [
            'question' => 'Employees must be treated kindly and must be given equal attention',
            'choices' => ['A) Order', 'B) Equity', 'C) Stability of Tenure of Personnel', 'D) Initiative'],
            'answer' => 'B'
        ],
        [
            'question' => 'Period of service should not be too short and employees should not be moved from positions frequently',
            'choices' => ['A) Stability of Tenure of Personnel', 'B) Equity', 'C) Initiative', 'D) Esprit de Corps'],
            'answer' => 'A'
        ],
        [
            'question' => 'Source of Strength for an organization because it provides new and better ideas.',
            'choices' => ['A) Initiative', 'B) Managers', 'C) Supervisor', 'D) Esprit de Corps'],
            'answer' => 'A'
        ],
        [
            'question' => 'Team spirit develops mutual trust and understanding it also helps finish tasks on time.',
            'choices' => ['A) Initiative', 'B) Equity', 'C) Esprit de Corps', 'D) Stability of Tenure of Personnel'],
            'answer' => 'C'
        ],
        [
            'question' => 'Which ancient civilizations practiced management in the construction of aqueducts and pyramids as early as 3000 B.C.?',
            'choices' => ['A) Greeks and Romans', 'B) Romans and Egyptians', 'C) Egyptians and Chinese', 'D) Greeks and Persians'],
            'answer' => 'B'
        ],
        [
            'question' => 'The Classical Approach (1890 - 1940) mainly focused on',
            'choices' => ['A) People-Oriented Management', 'B) Increasing Production', 'C) Strategic Planning', 'D) Technological Advancements'],
            'answer' => 'B'
        ],
        [
            'question' => 'Which management approach (1930s-1990s) emphasized understanding people and studying their interactions?',
            'choices' => ['A) Systems Approach', 'B) Contingency Approach', 'C) Behavioral Approach', 'D) Process Optimization'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the key feature of the Management Science Approach (1940s)?',
            'choices' => ['A) People-oriented strategies', 'B) Quantitative techniques for problem-solving', 'C) Strategic planning', 'D) Total quality management'],
            'answer' => 'B'
        ],
        [
            'question' => 'The Systems Approach (1950s) introduced which of the following concepts?',
            'choices' => ['A) Input, process, output, and environment', 'B) Total quality management', 'C) Benchmarking and reengineering', 'D) Contingency planning'],
            'answer' => 'A'
        ],
        [
            'question' => 'Which approach (1970s) introduced SWOT Analysis and Growth Share Matrix for strategic planning?',
            'choices' => ['A) Behavioral Approach', 'B) Contingency Approach', 'C) Classical Approach', 'D) Big Data'],
            'answer' => 'B'
        ],
        [
            'question' => 'Competitive advantage and technology-driven strategies were the focus of which management approach?',
            'choices' => ['A) Total Quality Management (1980s)', 'B) Systems Approach (1950s)', 'C) Process Optimization (1990s)', 'D) Classical Approach (1890-1940)'],
            'answer' => 'A'
        ],
        [
            'question' => 'Benchmarking and business process reengineering became popular in the:',
            'choices' => ['A) 1940s', 'B) 1950s', 'C) 1990s', 'D) 2000s'],
            'answer' => 'C'
        ],
        [
            'question' => 'The Big Data approach (2000s) focuses on:',
            'choices' => ['A) Increasing production efficiency', 'B) Understanding people’s behaviors', 'C) Using modern technologies to drive business decisions', 'D) Strategic planning with SWOT analysis'],
            'answer' => 'C'
        ],
        [
            'question' => 'Which management approach is associated with the use of numbers and quantitative techniques?',
            'choices' => ['A) Classical Approach', 'B) Management Science Approach','C) Behavioral Approach', 'D) Contingency Approach'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does GEMS stand for?',
            'choices' => ['A) Game, Exclusiveness, Managers, Sustainability', 'B) Goal Planning, Executing the Results, Managing the Setting, and Sustaining Operations', 'C) Goal Setting, Executing the Plan, Managing the Results, and Sustaining Operations', 'D) Goal Operations, Executing the Results, Managing the Plan, and Sustaining the Setting'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the first step in goal setting for a business?',
            'choices' => ['A) Executing the plan', 'B) Establishing objectives', 'C) Measuring results', 'D) Sustaining growth'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does data gathering focus on?',
            'choices' => ['A) Training employees', 'B) Identifying business requirements, market needs, and trends', 'C) Measuring business performance', 'D) Establishing final goals'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the purpose of formulating alternatives in business planning?',
            'choices' => ['A) To make a business plan more complicated', 'B) To prepare backup plans in case the original plan fails', 'C) To increase product prices', 'D) To eliminate the need for decision-making'],
            'answer' => 'B'
        ],
        [
            'question' => 'What must be done before making a final decision on a course of action?',
            'choices' => ['A) Compare the advantages and disadvantages of alternatives', 'B) Ignore alternative plans', 'C)Proceed without analysis',  'D) Focus only on competitors’ strategies'],
            'answer' => 'A'
        ],
        [
            'question' => 'Which of the following is NOT a part of executing the plan?',
            'choices' => ['A) Organizing resources', 'B) Communicating the plan to employees', 'C) Guiding the workforce', 'D) Measuring results'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the purpose of guiding employees?',
            'choices' => ['A) To teach them how to handle customers, especially difficult ones', 'B) To give them more paperwork', 'C) To reduce their responsibilities', 'D) To increase product costs'],
            'answer' => 'A'
        ],
        [
            'question' => 'Measuring results involves comparing actual activities with:',
            'choices' => ['A) Competitors’ performance', 'B) The company’s past failures', 'C) The planned activities', 'D) Customer complaints only'],
            'answer' => 'C'
        ],
        [
            'question' => 'What does sustaining growth focus on?',
            'choices' => ['A) Setting short-term goals', 'B) Ensuring long-term business success', 'C) Cutting down on employees', 'D) Reducing market demand'],
            'answer' => 'B'
        ],
        [
            'question' => 'Why is promoting change important in business?',
            'choices' => ['A) It helps maintain old business practices', 'B) It eliminates the need for innovation', 'C) It encourages improvement, creativity, and risk-taking', 'D) It reduces business risks'],
            'answer' => 'C'
        ],
        [
            'question' => 'Developing people within an organization includes:',
            'choices' => ['A) Delegation, empowerment, and continuous guidanc', 'B) Reducing workforce training', 'C) Ignoring employee concerns', 'D) Avoiding risk-taking'],
            'answer' => 'A'
        ],
        [
            'question' => 'Managers are responsible for:',
            'choices' => ['A) Only their own actions', 'B) The actions of their subordinates', 'C) The company’s marketing strategy only', 'D) Avoiding accountability'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is one way managers balance completing goals and setting priorities?',
            'choices' => ['A) Ignoring less important tasks', 'B) Assigning tasks to the appropriate person', 'C) Completing all tasks by themselves', 'D) Avoiding delegation'],
            'answer' => 'B'
        ],
        [
            'question' => 'Why is analytical thinking important for managers?',
            'choices' => ['A) It helps them break problems down into smaller components for better solutions', 'B) It allows them to avoid solving complex problems', 'C) It helps them focus only on short-term results', 'D) It prevents them from making decisions'],
            'answer' => 'A'
        ],
        [
            'question' => 'A manager who can view an entire task in an abstract way is demonstrating:',
            'choices' => ['A) Analytical thinking', 'B) Conceptual thinking', 'C) Task delegation', 'D) Conflict avoidance'],
            'answer' => 'B'
        ],
        [
            'question' => 'Why is it important for managers to act as mediators?',
            'choices' => ['A) To let conflicts continue naturally', 'B) To ensure disputes are resolved before they escalate', 'C) To take sides in disputes', 'D) To ignore conflicts within the team'],
            'answer' => 'B'
        ],
        [
            'question' => 'Managers are expected to make difficult decisions by:',
            'choices' => ['A) Avoiding conflicts and challenges', 'B) Coming up with solutions and following through with them', 'C) Letting employees solve their own problems', 'D) Waiting for upper management to solve all issues'],
            'answer' => 'B'
        ],
        [
            'question' => 'Which of the following is considered a hard skill?',
            'choices' => ['A) Self-management skills', 'B) Learning from school or training', 'C) Emotional intelligence (EQ)', 'D) Human performance'],
            'answer' => 'B'
        ],
        [
            'question' => 'Soft skills are mainly associated with:',
            'choices' => ['A) IQ (Left Brain)', 'B) Strictly following rules', 'C) Learning through interaction', 'D) Learning technical subjects'],
            'answer' => 'C'
        ],
        [
            'question' => 'What does job competency refer to?',
            'choices' => ['A) The ability to do a job properly and follow defined behaviors', 'B) Learning new hobbies', 'C) Following personal beliefs in the workplace', 'D) Relying only on soft skills'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the Iceberg Theory in people management?',
            'choices' => ['A) The deeper meaning of a story should always be obvious', 'B) Only visible skills matter in job performance', 'C) What is not immediately seen about a person is just as important', 'D) What is not immediately seen about a person is just as important'],
            'answer' => 'C'
        ],
        [
            'question' => 'Which level of proficiency in job competency refers to having extensive and in-depth experience?',
            'choices' => ['A) Minima', 'B) Basic', 'C) Proficient', 'D) Expert'],
            'answer' => 'D'
        ],
        [
            'question' => 'The word "values" comes from the word “valor,” which means:',
            'choices' => ['A) Integrity', 'B) Strength', 'C) Honor', 'D) Excellence'],
            'answer' => 'B'
        ],
        [
            'question' => 'Which core value ensures that a company exists and thrives?',
            'choices' => ['A) Excellence', 'B) Teamwork', 'C) Customer Focus', 'D) Creativity'],
            'answer' => 'C'
        ],
        [
            'question' => 'What Filipino value refers to having a sense of shame?',
            'choices' => ['A) Pakikiramdam', 'B) Utang na loob', 'C) Hiya', 'D) Amor propio'],
            'answer' => 'C'
        ],
        [
            'question' => ' "Bahala na" is a Filipino value that expresses:',
            'choices' => ['A) Strong teamwork', 'B) Reliance on fate or divine intervention', 'C) Focus on customer service', 'D) Strict rule-following'],
            'answer' => 'B'
        ],
        [
            'question' => 'Which Filipino trait reflects sensitivity to the feelings of others?',
            'choices' => ['A) Amor propio', 'B) Pakikiramdam', 'C) Hiya', 'D) Integrity'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is one of the primary roles of business in the economy?',
            'choices' => ['A) To create income and wealth', 'B) To regulate government policies', 'C) To eliminate competition', 'D) To avoid stakeholder relationships'],
            'answer' => 'A'
        ],
        [
            'question' => 'Ethics in business primarily deals with:',
            'choices' => ['A) Increasing profits at any cost', 'B) The morality of one’s actions and decisions', 'C) Avoiding all risks in decision-making', 'D) Following only legal requirements'],
            'answer' => 'B'
        ],
        [
            'question' => 'Corporate Social Responsibility (CSR) refers to:',
            'choices' => ['A) The obligation of businesses to benefit both the company and society', 'B) Prioritizing profits over social impact', 'C) Only following government regulations', 'D) Focusing solely on employee benefits'],
            'answer' => 'A'
        ],
        [
            'question' => 'Which of the following is NOT a factor in scanning the business environment?',
            'choices' => ['A) Political', 'B) Social', 'C) Personal Preferences', 'D) Technological'],
            'answer' => 'C'
        ],
        [
            'question' => 'What does the "E" in PESTEL analysis stand for?',
            'choices' => ['A) Economy and Ethics', 'B) Environment and Economic', 'C) Economic and Environmental', 'D) Ethics and Law'],
            'answer' => 'C'
        ],
        [
            'question' => 'In SWOT analysis, what term is used for an unfavorable external development that may slow down business performance?',
            'choices' => ['A) Strength', 'B) Weakness', 'C) Threat', 'D) Opportunity'],
            'answer' => 'C'
        ],
        [
            'question' => 'A company’s strong brand reputation would be considered a:',
            'choices' => ['A) Strength', 'B) Weakness', 'C) Threat', 'D) Opportunity'],
            'answer' => 'A'
        ],
        [
            'question' => 'Getting things done through people and delegating tasks with other people is known as:',
            'choices' => ['A) Leadership', 'B) Management', 'C) Delegation', 'D) Supervision'],
            'answer' => 'B'
        ],
        [
            'question' => ' Doing the instructions right and using resources efficiently to get things done properly is called:',
            'choices' => ['A) Productivity', 'B)  Innovation', 'C)  Effective', 'D) Performance'],
            'answer' => 'C'
        ],
        [
            'question' => 'The ability to maximize output while using the least amount of resources is known as:',
            'choices' => ['A) Efficiency', 'B) Effectiveness', 'C) Workload management', 'D) Strategic planning'],
            'answer' => 'A'
        ],
        [
            'question' => 'Individuals who carry out management tasks and ensure resources are used effectively and efficiently are called:',
            'choices' => ['A) Rank & File', 'B) Consultants', 'C) Managers', 'D) Shareholders'],
            'answer' => 'C'
        ],
        [
            'question' => 'The ordinary members of an organization as opposed to its leaders are referred to as:',
            'choices' => ['A) Stakeholders', 'B) Executives', 'C) Rank & File', 'D) Board of Directors'],
            'answer' => 'C'
        ],
        [
            'question' => 'Setting goals and specifying ways to attain them. It is a methodical technique of looking ahead to meet work requirements.',
            'choices' => ['A) Leading', 'B) Planning', 'C) Supervising', 'D) Delegating'],
            'answer' => 'B'
        ],
        [
            'question' => 'Assigning tasks and allocating people. Arranging parts to make it as a whole',
            'choices' => ['A) Controlling', 'B) Organizing', 'C) Influencing', 'D) Directing'],
            'answer' => 'B'
        ],
        [
            'question' => 'Guiding and directing the behavior of subordinates. Helping others to get the job well done',
            'choices' => ['A) Controlling', 'B) Evaluating', 'C) Influencing', 'D) Budgeting'],
            'answer' => 'C'
        ],
        [
            'question' => 'Monitor and check alignment of performance to predetermined standards:',
            'choices' => ['A) Assessing', 'B) Controlling ', 'C) Leading', 'D) Motivating'],
            'answer' => 'B'
        ],
        [
            'question' => 'Deciding what type of people should be hired and finding the right people for the right job',
            'choices' => ['A) Delegation', 'B) Recruitment', 'C) Staffing', 'D) Mentoring'],
            'answer' => 'C'
        ],
        [
            'question' => 'Ability to do something with a desired level of performance.',
            'choices' => ['A) Competency', 'B) Skills', 'C) Strategy', 'D) Knowledge'],
            'answer' => 'B'
        ],
        [
            'question' => 'Being able to carry out tasks with proficiency:',
            'choices' => ['A) Leadership Skills', 'B) Organizational Skills', 'C) Technical Skills', 'D) Public Speaking Skills'],
            'answer' => 'C'
        ],
        [
            'question' => 'Working with people and bringing out the best in them',
            'choices' => ['A) Human Skills ', 'B) Mechanical Skills', 'C) Digital Skills', 'D) Analytical Skills'],
            'answer' => 'A'
        ],
        [
            'question' => 'Being able to see the organization as a whole. Diagnosing the cause and effect relationship in the company.',
            'choices' => ['A) Logical Reasoning', 'B) Conceptual Skills', 'C) Decision-Making', 'D) Emotional Intelligence'],
            'answer' => 'B'
        ],
        [
            'question' => 'Managers handle problems and seize opportunities facing the organization',
            'choices' => ['A) Decisional Roles', 'B) Leadership Roles', 'C) Strategic Roles', 'D) Financial Roles'],
            'answer' => 'A'
        ],
        [
            'question' => 'Associated with interactions with various stakeholders regarding the mission and direction of organization.',
            'choices' => ['A) Operational Roles', 'B) Interpersonal Roles', 'C) Financial Roles', 'D) Administrative Roles'],
            'answer' => 'B'
        ],
        [
            'question' => 'Associated with tasks of obtaining and transmitting information',
            'choices' => ['A) Informational Roles', 'B) Customer Service', 'C) Conflict Resolution', 'D) Strategic Planning'],
            'answer' => 'A'
        ],
        [
            'question' => 'Whole work is to be divided into small tasks',
            'choices' => ['A) Division of Work', 'B) Workload Management', 'C) Work Specialization', 'D) Resource Allocation'],
            'answer' => 'A'
        ],
        [
            'question' => 'Superior giving enhanced order to subordinates by obligation for performance.',
            'choices' => ['A) Authority and Responsibility', 'B) Chain of Command', 'C) Leadership by Example', 'D) Performance Management'],
            'answer' => 'A'
        ],
        [
            'question' => 'Refers to obedience, proper conduct, respect, smooth functioning and shaping of culture',
            'choices' => ['A) Authority', 'B) Discipline', 'C) Compliance', 'D) Motivation'],
            'answer' => 'B'
        ],
        [
            'question' => 'Each subordinates should receive orders and be accountable to one superior.',
            'choices' => ['A) Unity of Command', 'B) Chain of Supervision', 'C) Organizational Hierarchy', 'D) Task Delegation'],
            'answer' => 'A'
        ],
        [
            'question' => 'All working on the same line, pursuing the same objective. To ensure unity in action, focusing on efforts.',
            'choices' => ['A) Unity of Effort', 'B) Focused Management', 'C) Unity of Direction', 'D) Organizational Efficiency'],
            'answer' => 'C'
        ],
        [
            'question' => 'Interests of organizational goals prevails over personal interest of individuals',
            'choices' => ['A) Ethical Management', 'B) Subordination of Individual Interest', 'C) Selfless Leadership', 'D) Collective Responsibility'],
            'answer' => 'B'
        ],
        [
            'question' => 'Chief motivation & influences productivity. It should be fair, reasonable, and rewarding of effort',
            'choices' => ['A) Incentives', 'B) Performance Evaluation', 'C) Remuneration', 'D) Salary Structure'],
            'answer' => 'C'
        ],
        [
            'question' => 'Concentration of decision-making authority at the top management.',
            'choices' => ['A) Delegation', 'B) Hierarchy', 'C) The Degree of Centralization', 'D) Management Distribution'],
            'answer' => 'C'
        ],
        [
            'question' => 'Chain of command, superiors ranging from top to lowest rank. Also called as ‘gangplank',
            'choices' => ['A) Authority Line', 'B) Management Chain', 'C) Scalar Chain', 'D) Functional Hierarchy'],
            'answer' => 'C'
        ],
        [
            'question' => 'Should be acceptable and under the rules of the company.',
            'choices' => ['A) Regulation', 'B) Order', 'C) Compliance Policy', 'D) Corporate Code'],
            'answer' => 'B'
        ],
        [
            'question' => 'Employees must be treated kindly and must be given equal attention.',
            'choices' => ['A) Fairness Policy', 'B) Employee Welfare', 'C) Equity', 'D) Workplace Ethics'],
            'answer' => 'C'
        ],
        [
            'question' => 'Period of service should not be too short and employees should not be moved from positions frequently.',
            'choices' => ['A) Employee Rotation', 'B) Stability of Tenure of Personnel', 'C) Workforce Retention', 'D) Contractual Planning'],
            'answer' => 'B'
        ],
        [
            'question' => 'Source of strength for an organization because it provides new and better ideas.',
            'choices' => ['A) Creativity', 'B) Initiative', 'C) Brainstorming', 'D) Motivation'],
            'answer' => 'B'
        ],
        [
            'question' => 'Team spirit develops mutual trust and understanding; it also helps finish tasks on time.',
            'choices' => ['A) Organizational Culture', 'B) Group Work', 'C) Esprit de Corps', 'D) Collective Leadership'],
            'answer' => 'C'
        ],
 
        [
            'question' => 'Ancient civilizations who practiced management in the construction of aqueducts and pyramids as early as 3000 B.C.?',
            'choices' => ['A) Greeks and Persians', 'B) Romans and Egyptians', 'C) Mayans and Aztecs', 'D) Chinese and Indians'],
            'answer' => 'B'
        ],
        [
            'question' => 'The Classical Approach (1890 - 1940) mainly focused on:',
            'choices' => ['A) Employee Relations', 'B) Increasing Production', 'C) Innovation Strategies', 'D) Marketing Efficiency'],
            'answer' => 'B'
        ],
        [
            'question' => 'Management approach (1930s-1990s) emphasized understanding people and studying their interactions?',
            'choices' => ['A) Scientific Approach', 'B)  Behavioral Approach', 'C) Structural Approach', 'D) Process-Oriented Management'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the key feature of the Management Science Approach (1940s)?',
            'choices' => ['A) Financial Models', 'B) Quantitative Techniques for Problem-Solving', 'C) Employee Training', 'D) Human-Centered Decisions'],
            'answer' => 'B'
        ],
        [
            'question' => 'The Systems Approach (1950s) introduced which of the following concepts?',
            'choices' => ['A) Input, Process, Output, and Environment', 'B) Profit Maximization', 'C) Competitive Edge', 'D) Employee Satisfaction'],
            'answer' => 'A'
        ],
        [
            'question' => 'Which approach (1970s) introduced SWOT Analysis and Growth Share Matrix for strategic planning?',
            'choices' => ['A) Contingency Approach', 'B) Forecasting Strategy', 'C) Goal-Oriented Approach', 'D) Business Mapping'],
            'answer' => 'A'
        ],
        [
            'question' => 'Competitive advantage and technology-driven strategies were the focus of which management approach?',
            'choices' => ['A) Strategic Expansion', 'B) Total Quality Management (TQM)', 'C) Business Operations', 'D) Industrial Management'],
            'answer' => 'B'
        ],
        [
            'question' => 'Benchmarking and business process reengineering became popular in the:',
            'choices' => ['A) 1990s', 'B) 1980s', 'C) 2000s', 'D) 2010s'],
            'answer' => 'A'
        ],
    
        [
            'question' => 'The Big Data approach (2000s) focuses on:',
            'choices' => ['A) Financial Planning', 'B) Human Resource Development', 'C) Using Modern Technologies to Drive Business Decisions', 'D) Digital Communication'],
            'answer' => 'C'
        ],
        [
            'question' => 'Which management approach is associated with the use of numbers and quantitative techniques?',
            'choices' => ['A) Team-Based Solutions', 'B) Organizational Behavior', 'C) Management Science Approach', 'D) Leadership Models'],
            'answer' => 'C'
        ],
        [
            'question' => 'What does GEMS stand for?',
            'choices' => ['A) General Employee Monitoring System', 'B) Global Enterprise Management Studies', 'C) Growth and Expansion of Market Strategies', 'D) Goal Setting, Executing the Plan, Managing the Results, and Sustaining Operations'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the first step in goal setting for a business?',
            'choices' => ['A) Defining a Budget', 'B) Analyzing Competition', 'C) Hiring Staff', 'D) Establishing Objectives'],
            'answer' => 'D'
        ],
        [
            'question' => 'What does data gathering focus on?',
            'choices' => ['A) Internal Employee Relations', 'B) Managing Production Lines', 'C) Identifying Business Requirements, Market Needs, and Trends', 'D) Cost Minimization'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the purpose of formulating alternatives in business planning?',
            'choices' => ['A) Preparing Backup Plans in Case the Original Plan Fails', 'B)  Enhancing Customer Engagement', 'C) Reducing Employee Workload', 'D) Strengthening Leadership Skills'],
            'answer' => 'A'
        ],
        [
            'question' => 'What must be done before making a final decision on a course of action?',
            'choices' => ['A) Compare the Advantages and Disadvantages of Alternatives', 'B) Implement Immediately', 'C) Seek External Funding', 'D) Consult a Lawyer'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the purpose of guiding employees?',
            'choices' => ['A) Expanding Product Lines', 'B) Teaching Them How to Handle Customers, Especially Difficult Ones', 'C) Strengthening Hierarchical Structures', 'D) Monitoring Market Trends'],
            'answer' => 'B'
        ],
        [
            'question' => 'Measuring results involves comparing actual activities with:',
            'choices' => ['A) Competitor Performance', 'B) Annual Revenue', 'C) The Initial Budget', 'D) The Planned Activities'],
            'answer' => 'D'
        ],
        [
            'question' => 'What does sustaining growth focus on?',
            'choices' => ['A) Ensuring Long-Term Business Success', 'B) Product Launches', 'C) Short-Term Profits', 'D) Employee Satisfaction'],
            'answer' => 'A'
        ],
        [
            'question' => 'Why is promoting change important in business?',
            'choices' => ['A) It Increases Employee Turnover', 'B) It Encourages Improvement, Creativity, and Risk-Taking', 'C) It Complicates Decision-Making', 'D) It Reduces Productivity'],
            'answer' => 'B'
        ],
        [
            'question' => 'Developing people within an organization includes:',
            'choices' => ['A) Limiting Career Growth', 'B) Strengthening Bureaucracy', 'C) Reducing Working Hours', 'D) Delegation, Empowerment, and Continuous Guidance'],
            'answer' => 'D'
        ],
        [
            'question' => 'Managers are responsible for:',
            'choices' => ['A) The Actions of Their Subordinates', 'B) Media Relations', 'C) Budget Planning', 'D) Client Acquisition'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is one way managers balance completing goals and setting priorities?',
            'choices' => ['A) Delegating Everything', 'B) Avoiding Responsibilities', 'C) Assigning Tasks to the Appropriate Person', 'D) Waiting for Deadlines'],
            'answer' => 'C'
        ],
        [
            'question' => 'A manager who can view an entire task in an abstract way is demonstrating:',
            'choices' => ['A) Technical Mastery', 'B) Strategic Focus', 'C) Hands-On Leadership', 'D) Conceptual Thinking'],
            'answer' => 'D'
        ],
        [
            'question' => 'Why is it important for managers to act as mediators?',
            'choices' => ['A) To Ensure Disputes are Resolved Before They Escalate', 'B) To Enforce Strict Policies', 'C) To Avoid Conflict', 'D) To Punish Employees'],
            'answer' => 'A'
        ],
        [
            'question' => 'Managers are expected to make difficult decisions by:',
            'choices' => ['A) Coming Up with Solutions and Following Through with Them', 'B) Waiting for Consensus', 'C) Assigning the Issue to Someone Else', 'D) Ignoring the Situation'],
            'answer' => 'B'
        ],
        [
            'question' => 'The process of arranging resources to achieve objectives is called?',
            'choices' => ['A) Planning', 'B) Organizing', 'C) Controlling', 'D) Directing'],
            'answer' => 'B'
        ]

        ],

        'Marketing' => [
            [
                'question' => 'It communicates the value of a product, service or brand to customers, for the  purpose of promoting or selling that product, service, or brand.',
                'choices' => ['A) Selling', 'B)  Marketing', 'C) Management', 'D) Organization'],
                'answer' => 'B'
            ],
            [
                'question' => 'The feeling that a product has met or exceeded the customer’s expectations',
                'choices' => ['A) Customer Loyalty', 'B) Customer Complaints', 'C) Customer Expectations', 'D) Customer Satisfaction '],
                'answer' => 'D'
            ],
            [
                'question' => 'He defines marketing as satisfying needs and wants through an exchange process.',
                'choices' => ['A) Philip Kotler', 'B) Abraham Maslow', 'C) Bill Gates', 'D) Steve Jobs'],
                'answer' => 'A'
            ],
            [
                'question' => "It's the customer's perception of the overall quality or superiority of a product or service with respect to its intended purpose, relative to alternatives.",
                'choices' => ['A) Perceived Value', 'B) Channel Distribution', 'C) Marketing Research', 'D) Perceived Quality'],
                'answer' => 'D'
            ],
            [
                'question' => 'When a customer is willing and having the ability to buy that needs or wants.',
                'choices' => ['A) Power', 'B) Demand', 'C) Wants', 'D) Needs'],
                'answer' => 'B'
            ],
            [
                'question' => 'Satisfying needs and wants means meeting expectations on particular needs and wants.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'A'
            ],
            [
                'question' => '',
                'choices' => ['A) True', 'B) False'],
                'answer' => ''
            ],
            [
                'question' => 'The basic difference between wants and demands is needs.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'B'
            ],
            [
                'question' => 'The first level of Hierarchy of Needs is Self-Actualization.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'B'
            ],
            [
                'question' => 'Pricing is the only element of marketing which generates revenue for the firm.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'A'
            ],
            [
                'question' => 'Feedback from customers is important in marketing.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'A'
            ],
            [
                'question' => 'Dividing a broad target market into subsets of consumers then designing and implementing strategies to target them.',
                'choices' => ['A) Target Market', 'B) Market Segmentation', 'C) Market Persona', 'D) Customer Target'],
                'answer' => 'B'
            ],
            [
                'question' => 'A segmentation that seeks to understand them and their lifestyle and key values and activities.',
                'choices' => ['A) Geographic Segmentation', 'B) Behavioral Segmentation', 'C) Demographic Segmentation', 'D) Psychographic Segmentation'],
                'answer' => 'D'
            ],
            [
                'question' => 'A segmentation that divides the market based on age, gender, income, family size, lifecycle.',
                'choices' => ['A) Geographic Segmentation', 'B) Behavioral Segmentation', 'C) Demographic Segmentation', 'D) Psychographic Segmentation'],
                'answer' => 'C'
            ],
            [
                'question' => 'A segmentation that groups customers based on where they live.',
                'choices' => ['A) Geographic Segmentation', 'B) Behavioral  Segmentation', 'C) Demographic Segmentation', 'D) Psychographic Segmentation'],
                'answer' => 'A'
            ],
            [
                'question' => 'A segmentation that divides customers into segments depending on their behavior patterns when interacting with a particular business.',
                'choices' => ['A) Geographic Segmentation', 'B) Behavioral  Segmentation', 'C) Demographic Segmentation', 'D) Psychographic Segmentation'],
                'answer' => 'B'
            ],
            [
                'question' => 'In profiling you need to consider 2 things, your target market and their profile.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'A'
            ],
            [
                'question' => 'They pay attention to the price and are focused more on quality.',
                'choices' => ['A) Hedonist', 'B) Traditionalist', 'C) Performers', 'D) Minimalist'],
                'answer' => 'A'
            ],
            [
                'question' => 'They like to keep things simple and only buy what they need.',
                'choices' => ['A)  Hedonist', 'B) Traditionalist', 'C) Performers', 'D) Minimalist'],
                'answer' => 'D'
            ],
            [
                'question' => 'They like high-tech products and care about the reputation of the brand.',
                'choices' => ['A) Hedonist', 'B) Traditionalist', 'C) Performers', 'D) Minimalist'],
                'answer' => 'C'
            ],
            [
                'question' => 'They value tradition and buy environmentally friendly products.',
                'choices' => ['A) Hedonist', 'B) Traditionalist', 'C) Performers', 'D) Minimalist'],
                'answer' => 'B'
            ],
            [
                'question' => 'Considers the entire market as the target market.',
                'choices' => ['A) Targeting', 'B) Undifferentiated Marketing', 'C) Differentiated Marketing', 'D) Concentrated Marketing'],
                'answer' => 'B'
            ],
            [
                'question' => 'Considers the different segments in the market',
                'choices' => ['A) Targeting', 'B) Undifferentiated Marketing', 'C) Differentiated Marketing', 'D) Concentrated Marketing'],
                'answer' => 'C'
            ],
            [
                'question' => 'Business develops products for one segment..',
                'choices' => ['A) Targeting', 'B) Undifferentiated Marketing', 'C) Differentiated Marketing', 'D) Concentrated Marketing'],
                'answer' => 'D'
            ],
            [
                'question' => 'Rice is an example of what target strategies?',
                'choices' => ['A) Targeting', 'B) Undifferentiated Marketing', 'C) Differentiated Marketing', 'D) Concentrated Marketing'],
                'answer' => 'B'
            ],
            [
                'question' => 'The Rolex is an example of what target strategies?',
                'choices' => ['A) Targeting', 'B) Undifferentiated Marketing', 'C) Differentiated Marketing', 'D) Concentrated Marketing'],
                'answer' => 'D'
            ],
            [
                'question' => 'Study of consumers and the process they use.',
                'choices' => ['A) Company Behavior', 'B) Business Behavior', 'C) Competitor Behavior', 'D) Consumer Behavior'],
                'answer' => 'D'
            ],
            [
                'question' => 'Visually display the perceptions of the target market on the product relative to competitors.',
                'choices' => ['A) Perceptual Mapping', 'B) Geographic Mapping', 'C) Demographic Mapping', 'D) Concentrated Mapping'],
                'answer' => 'A'
            ],
            [
                'question' => 'What kind of involvement happens for large or expensive purchases?',
                'choices' => ['A)  Low Involvement', 'B) Small Involvement', 'C) High involvement', 'D) Large Involvement'],
                'answer' => 'C'
            ],
            [
                'question' => 'Below are the the examples of factors influencing consumer behavior except:',
                'choices' => ['A) Cultural', 'B) Personal', 'C) Political', 'D) Social'],
                'answer' => 'C'
            ],
            [
                'question' => 'What kind of involvement happens for regular or small purchases?',
                'choices' => ['A) Low Involvement', 'B) Small Involvement', 'C) High involvement', 'D) Large Involvement'],
                'answer' => 'A'
            ],
            [
                'question' => 'It is the process of creating a distinct identity for a business in the minds of your target audience and the general population.',
                'choices' => ['A) Selling', 'B) Marketing', 'C) Marketing', 'D) Promoting'],
                'answer' => 'C'
            ],
            [
                'question' => 'These are short, memorable catch phrases used in advertising campaigns designed to create product affiliations among consumers.',
                'choices' => ['A) Slogan', 'B) Trademark', 'C) Logo', 'D) Brand Mark'],
                'answer' => 'C'
            ],
            [
                'question' => 'It refers to consumer perceptions linked to a particular brand such as health, excitement, fun or family.',
                'choices' => ['A) Brand Image', 'B) Brand Awareness', 'C) Brand Loyalty', 'D) Brand Mark'],
                'answer' => 'A'
            ],
            [
                'question' => 'It is the updating or creation of a new name, term, symbol, design, or a combination thereof for an established brand with the intention of developing a differentiated position in the mind of stakeholders and competitors.',
                'choices' => ['A) Brand Image', 'B) Rebranding', 'C) Brand Loyalty', 'D) Cobranding'],
                'answer' => 'B'
            ],
            [
                'question' => 'It refers to the use of a successful brand name to launch a new or modified product or service in a new market',
                'choices' => ['A) Brand Extension', 'B) Brand Equity', 'C) Brand Loyalty', 'D) Brand Image'],
                'answer' => 'A'
            ],
            [
                'question' => 'It’s a form of brand that represents an entire company or organization.',
                'choices' => ['A) Corporate Brand', 'B) Product Brand', 'C) Store Brand', 'D) None of the Above'],
                'answer' => 'A'
            ],
            
                'question' => 'Is the value placed on a brand by consumers.',
                'choices' => ['A) Brand Extension', 'B) Brand Equity', 'C) Brand Loyalty', 'D) Brand Image'],
                'answer' => 'B'
            ],
            [
                'question' => 'Event branding opportunities may include:',
                'choices' => ['A) Naming Events Offerings', 'B) Promotions and Co-Promotions', 'C) Hospitality', 'D) All of the above'],
                'answer' => 'D'
            ],
            [ 
                'question' => 'Strong brands have the power to create business value and impact more than just corporate revenues and profit margins.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'A'
            ],
            [
                'question' => 'When a brand name or trade name is registered.',
                'choices' => ['A) Slogan', 'B) Trademark', 'C) Logo', 'D) Brand Mark'],
                'answer' => 'B'
            ],
            [
                'question' => 'Refers to the functions and features of a good or service.',
                'choices' => ['A) Product', 'B) Price', 'C) Promotion', 'D) Place'],
                'answer' => 'A'
            ],
            [
                'question' => 'Strategies to make the consumer aware of the existence of a product or service',
                'choices' => ['A) Product', 'B) Price', 'C) Promotion', 'D) Place'],
                'answer' => 'C'
            ],
            [ 
                'question' => 'One that buys merchandise from manufacturers and sells it to retailers.',
                'choices' => ['A) Teller', 'B) Seller', 'C) Jobber', 'D) Buyer'],
                'answer' => 'C'
            ],
            [
                'question' => 'The ambience, mood or physical presentation of the environment.',
                'choices' => ['A) Product', 'B) Physical Environment', 'C) Process', 'D) People'],
                'answer' => 'B'
            ],
            [ 
                'question' => 'The one who must accept prevailing prices in a market.',
                'choices' => ['A) Loss Leader', 'B) Loss Taker', 'C) Price Leader', 'D) Price Taker'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is the meaning of USP?',
                'choices' => ['A) Unit Selling Production', 'B) Unique Selling Proposition', 'C) Unit Segmentation Positioning', 'D) Unique Segmentation Positioning	'],
                'answer' => 'B'
            ],
            [
                'question' => 'How many stages is the product cycle?',
                'choices' => ['A) 4', 'B) 5', 'C) 6', 'D) 7'],
                'answer' => 'B'
            ],
            [
                'question' => 'Building the relationship between the firm and the public by enhancing its reputation.',
                'choices' => ['A) Public Relations', 'B) Direct Mailing', 'C) Digital', 'D) Sales Promotion'],
                'answer' => 'A'
            ],
            [ 
                'question' => 'Promotion must be the one that the customer thinks is good value for money.',
                'choices' => ['A) True', 'B) False'],
                'answer' => 'B'
            ],
            [
                'question' => 'It is a must for a business to do this kind of marketing because it is the highest platform being consumed by all ages.',
                'choices' => ['A) Mailing', 'B) Traditional', 'C) Digital', 'D) None of the above'],
                'answer' => 'C'
            ],
            [ 
                'question' => 'What does the course “Introduction to Marketing” focus on?',
                'choices' => ['A) Financial Accounting Principles', 'B) Organizational Behavior and Leadership', 'C) The Development of Integrated Marketing Programs to Grow Businesses', 'D) Legal Aspects of Business Operations'],
                'answer' => 'C'
            ],
            [
                'question' => 'What are the key roles of marketing in business?',
                'choices' => ['A) Managing Employee Payroll', 'B) Informing, Engaging, Building Reputation, Selling, and Growing Businesses', 'C) Handling Legal Compliance and Taxation', 'D) Supervising Production and Inventory'],
                'answer' => 'B'
            ],
            [
                'question' => 'How is marketing defined?',
                'choices' => ['A) Marketing is an organizational function and set of processes that will benefit the organization and its stakeholders. Marketing is communicating the value of the product or service for the purpose of promoting or selling. ', 'B) Marketing is a strategy solely focused on increasing product prices.', 'C) Marketing is the process of managing internal company operations.', 'D) Marketing is primarily about financial planning and budgeting.'],
                'answer' => 'A'
            ],
            [
                'question' => 'How does Philip Kotler define marketing?',
                'choices' => ['A) He defines marketing as the legal regulation of business transactions.', 'B) He defines marketing as a process of financial investment and budgeting.', 'C) He defines marketing as the act of managing employee relations.', 'D) He defines marketing as satisfying needs and wants through an exchange process.'],
                'answer' => 'D'
            ],
            [ 
                'question' => 'What does satisfaction mean in marketing?',
                'choices' => ['A) If expectations are met. Satisfying needs and wants means meeting an expectation.', 'B) Understanding Needs, Wants, and Demands.', 'C) The process of identifying target markets.', 'D) The strategy of increasing product pricing.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What are needs in marketing?',
                'choices' => ['A) Basic human requirements which are essential for a human to survive. Shelter, food, water, clothes.', 'B) The desire for luxury goods and entertainment.', 'C) A company’s strategy for increasing market share.', 'D) The process of creating advertising campaigns.'],
                'answer' => 'A'
            ],
            [ 
                'question' => 'What are wants in marketing?',
                'choices' => ['A) A legal obligation for businesses to fulfill.', 'B) The process of distributing products to retailers.', 'C) Desired by a customer. Not required for human survival.', 'D) Basic human requirements essential for survival.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is the demand in marketing?',
                'choices' => ['A) A strategy used to promote luxury products.', 'B) Customer is willing and has the ability to buy that needs or wants. Basic difference between want and demand is desire.', 'C) The number of products a company produces annually.', 'D) A government regulation that controls pricing in the market.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What are physiological needs in Maslow’s hierarchy?',
                'choices' => ['A) Physiological needs are the basic human requirements necessary for survival, including air, water, food, shelter, sleep, clothing, and reproduction.', 'B) Physiological needs focus on personal achievements and self-fulfillment.', 'C) Physiological needs involve the desire for social connections and belonging.', 'D) Physiological needs refer to the need for status, recognition, and prestige.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What are safety needs in Maslow’s hierarchy?',
                'choices' => ['A) Safety needs include personal security, employment, resources, health, and property, ensuring stability and protection in life.', 'B) Safety needs focus on creativity, problem-solving, and self-actualization', 'C) Safety needs involve forming relationships, friendships, and social connections', 'D) Safety needs are about gaining recognition, respect, and status from others.'],
                'answer' => 'A'
            ],
            [ 
                'question' => 'What does the love and belonging level of Maslow’s hierarchy focus on?',
                'choices' => ['A) This level emphasizes financial security, employment, and physical safety.', 'B) This level is about meeting basic survival needs such as food, water, and shelter.', 'C) This level focuses on achieving self-fulfillment and personal growth.', 'D) This level focuses on relationships and connection, including friendship, intimacy, family, and a sense of belonging.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What are esteem needs in Maslow’s hierarchy?',
                'choices' => ['A) Esteem needs involve respect, self-esteem, status, recognition, strength, and freedom, which help individuals feel valued and confident.', 'B) Esteem needs focus on physical survival, including food, water, and shelter.', 'C) Esteem needs relate to forming social connections like friendship and intimacy', 'D) Esteem needs are primarily about job security and financial stability.'],
                'answer' => 'A'
            ],
            [ 
                'question' => 'What is self-actualization in Maslow’s hierarchy?',
                'choices' => ['A) Self-actualization is the desire to become the most that one can be, fulfilling one’s full potential.', 'B) The need for financial security and stable employment.', 'C) The pursuit of social relationships and a sense of belonging.', 'D) The requirement for basic survival, including food and shelter.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What are included in products and services?',
                'choices' => ['A) Employee benefits, company policies, and customer feedback.', 'B) Nature and type of products. Quality, design, branding, labeling, packaging', 'C) Corporate social responsibility, ethical marketing, and sustainability', 'D) Market research, promotional campaigns, and digital marketing strategies.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What does marketing research analyze?',
                'choices' => ['A) Market regulations, legal policies, and business laws.', 'B) Internal company operations, employee performance, and cost reduction', 'C) An analysis of nature and types of customers. Customer focused.', 'D) Environmental factors, climate change effects, and sustainability reports.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is a channel of distribution?',
                'choices' => ['A) A method for setting product pricing and financial budgeting', 'B) A system for managing employee roles and responsibilities.', 'C) A strategy for increasing brand awareness through advertising.', 'D) Pathway through which goods move from producer to consumer.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is the objective of promotional decisions?',
                'choices' => ['A) Promotion has the basic objective of informing the market about product availability and creating a demand for it', 'B) Promotion focuses solely on increasing production efficiency.', 'C) Promotion aims to regulate internal company policies.', 'D) Promotion is primarily used to control employee performance.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is the importance of pricing decisions?',
                'choices' => ['A) It primarily focuses on employee satisfaction.', 'B) It ensures that only luxury products are sold.', 'C) It is the only element of marketing which generates revenue for the firm.', 'D) It regulates the hiring process within a company.'],
                'answer' => 'C'
            ],
            [
                'question' => 'Why is customer feedback important?',
                'choices' => ['A) It ensures that only positive reviews are shared publicly.', 'B) A proper feedback mechanism should be developed so that failures may be identified and improvements may be made.', 'C) It eliminates the need for further market research.', 'D) It guarantees that all products will be successful.'],
                'answer' => 'B'
            ],
            [
                'question' => 'How does marketing relate to social responsibility?',
                'choices' => ['A) Marketing is solely focused on generating revenue without societal concerns.', 'B) Social activities are a part of marketing as the units have to protect and promote the interest of society.', 'C) Marketing avoids involvement in any form of social responsibility.', 'D) Social responsibility is only relevant to non-profit organizations, not marketing.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is customer satisfaction?',
                'choices' => ['A) The feeling that a product has met or exceeded the customer’s expectations.', 'B) The process of persuading customers to buy unnecessary products.', 'C) A strategy to increase company profits without improving service.', 'D) A marketing tactic that disregards customer feedback.'],
                'answer' => 'A'
            ],
            [
                'question' => 'How can businesses ensure customer satisfaction?',
                'choices' => ['A) Businesses should focus only on increasing sales without customer engagement.', 'B) By ignoring complaints and prioritizing internal company goals.', 'C) Businesses must meet or exceed customer expectations, focus on delighting customers, provide solutions to customer problems, and cultivate relationships rather than just one-time transactions.', 'D) By limiting communication with customers to avoid feedback.'],
                'answer' => 'C'
            ],
            [
                'question' => 'How is customer satisfaction measured?',
                'choices' => ['A) It is measured through surveys and ratings. An organization’s main focus must be to satisfy its customers.', 'B) It is measured solely by how much revenue a company generates.', 'C) By monitoring the number of product returns without customer input.', 'D) Through company assumptions rather than direct customer feedback.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is perceived quality?',
                'choices' => ['A) It is the actual manufacturing cost of a product.', 'B) It is the company internal evaluation of product performance.', 'C) It is the legal standard for product durability.', 'D) It is the customer’s perception of the overall quality or superiority of a product.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What are customer expectations?',
                'choices' => ['A) The legal requirements imposed on businesses by regulatory authorities.', 'B) The expected perceived value, behavior, service, or benefits that customers seek.', 'C) The internal goals a company sets for its employees.', 'D) The financial projections made by a business for future growth.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is perceived value?',
                'choices' => ['A) It is the total production cost of a product set by the manufacturer.', 'B) It is the financial worth of a company’s stock in the market.', 'C) It is the evaluated value that a customer perceives to obtain by buying a product.', 'D) It is the legal valuation of a company’s assets.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is a target market?',
                'choices' => ['A) A random selection of customers who accidentally purchase a product.', 'B) A government-regulated sector that controls business operations.', 'C) A company’s internal team responsible for financial planning.', 'D) A specific group of people you have decided to target with your product or services. It could be a large market or a niche market.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is a market in marketing?',
                'choices' => ['A) A government-regulated space for trading goods and services.', 'B) A group of consumers who share similar needs and wants and are capable of buying.', 'C) A physical store where only essential goods are sold.', 'D) A company’s internal department for managing expenses.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is a penetrated market segment?',
                'choices' => ['A) A section of the market that has been explored but remains unprofitable.
    ', 'B) A group of potential buyers who have not yet been reached.', 'C) Consumers in the target market who have purchased the product.', 'D) The market share controlled by competitors.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What does the combination of penetrated and unpenetrated market segments mean?',
                'choices' => ['A) A market that consists of only repeat customers.', 'B) A group of consumers who have rejected the product.', 'C) It refers to the target market that includes both consumers who have purchased the product and those who have not yet purchased it.', 'D)  A segment that focuses solely on brand-loyal customers.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is market segmentation?',
                'choices' => ['A) A process of merging different market groups into a single audience.', 'B) Dividing the markets into segments of customers by separating a broad target market into subsets of consumers, then designing and implementing strategies to target them.', 'C) Eliminating niche markets to focus on mass production.', 'D) A strategy that ignores customer differences and treats all consumers the same.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is geographic segmentation?',
                'choices' => ['A) Categorizing customers based on their social status.', 'B)  Grouping customers based on where they live.', 'C) Dividing customers according to their income levels.', 'D)  Grouping customers based on their interests and hobbies.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is geographic segmentation?',
                'choices' => ['A) Dividing customers based on their income level.', 'B) Categorizing customers by their shopping habits.', 'C) Geographic segmentation involves grouping customers based on where they live.', 'D) Segmenting customers according to their education level.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What are different geographical units in geographic segmentation?',
                'choices' => ['A) The different geographical units include regions such as continents, countries, and states, as well as the size of the area based on population.', 'B) Geographical units are based only on climate variations.', 'C) Geographical segmentation ignores regional differences.', 'D) The different geographical units include only cities and urban areas.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What are the types of areas considered in geographic segmentation?',
                'choices' => ['A) Geographic segmentation only considers urban areas.', 'B) Rural and suburban areas are not included in geographic segmentation.', 'C) The types of areas considered are rural, suburban, and urban. Rural areas are in the countryside or probinsya, suburban areas are just outside a city or town with many houses, and urban areas have a lot of commercial buildings.', 'D) Only countries and continents are considered in geographic segmentation.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What other factors are considered in geographic segmentation?',
                'choices' => ['A) Climate and population density.', 'B) Only the economic status of the population.', 'C) The number of businesses in an area.', 'D) Consumer buying habits regardless of location.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is demographic segmentation?',
                'choices' => ['A) Segmentation occurs through consumer opinions and interests.', 'B) Demographic segmentation divides the market based on age, gender, income, family size, and lifecycle.', 'C) It classifies consumers based on their purchasing locations.', 'D) Income, age, gender, family size, and lifecycle divide the market.'],
                'answer' => 'B'
            ],
            [
                'question' => 'How does age affect marketing strategies?',
                'choices' => ['A) Marketing strategies remain the same regardless of the target audiences age.', 'B) Age has no impact on marketing strategies.', 'C) Products are only marketed to younger consumers.', 'D) Marketers design, package, and promote products differently to meet the wants of different age groups.'],
                'answer' => 'D'
            ],
            [
                'question' => 'Who are the Baby Boomers, and what are their characteristics?',
                'choices' => ['A) Baby Boomers are digital natives who primarily consume content through social media and streaming platforms.', 'B) Baby Boomers are defined by their preference for minimalist lifestyles and online shopping trends.', 'C) Baby Boomers prioritize virtual reality experiences and are the most active users of cryptocurrency.', 'D) Baby Boomers are the biggest consumers of traditional media like newspapers. 90% of them use Facebook to communicate with loved ones, and they have begun to adopt more technology. They are also interested in locally sourced products.'],
                'answer' => 'D'
            ],
            [
                'question' => 'Who are Gen X, and what are their characteristics?',
                'choices' => ['A) Gen X primarily consumes content through social media and rarely watches traditional television.', 'B) Gen X is known for being the earliest adopters of cryptocurrency and virtual reality technology.', 'C) Gen X still reads newspapers and watches TV a lot. They are digitally savvy, the biggest spenders on groceries, and are loyal to their brands.', 'D) Gen X prefers minimalist lifestyles and avoids brand loyalty in their purchasing decisions.'],
                'answer' => 'C'
            ],
            [
                'question' => 'Who are Gen Y (Millennials), and what are their characteristics?',
                'choices' => ['A) Gen Y still watches TV, but Netflix is more popular. They are comfortable with mobile devices, have multiple social media accounts, use technology to shop and save, and value convenience over brand loyalty.', 'B) Gen Y prefers traditional shopping methods and avoids online purchases.', 'C) Gen Y does not engage with social media or digital platforms.', 'D) Gen Y relies solely on brand loyalty when making purchasing decisions.'],
                'answer' => 'A'
            ],
            [
                'question' => 'Who are Gen Z, and what are their characteristics?',
                'choices' => ['A) They prefer landline communication and avoid using smartphones.', 'B) They grew up using their parents’ mobile phones, prefer smartphones for communication, and are dedicated to healthy, organic products.', 'C) They received their first mobile phone at an average age of 18 years.', 'D) They rely solely on traditional media like newspapers and radio for information.
    
    
    
    
    
    
    
    '],
                'answer' => 'B'
            ],
            [
                'question' => 'What is gender segmentation?',
                'choices' => ['A) Gender segmentation focuses only on income levels to market products.', 'B) Gender segmentation is widely used in consumer marketing to target products and services based on gender.', 'C) Gender segmentation is the process of dividing consumers based on their geographical location.', 'D) Gender segmentation does not play a role in consumer marketing.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What industries commonly use gender segmentation?
    
    ',
                'choices' => ['A) Technology, Automobiles, Construction, and Agriculture', 'B) Aviation, Pharmaceuticals, Logistics, and Mining', 'C) Industries that commonly use gender segmentation include clothing, hairdressing, magazines, and cosmetics.', 'D) Engineering, Software Development, Finance, and Real Estate'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is psychographic segmentation?',
                'choices' => ['A) Dividing customers based on their age, gender, and income.', 'B) Segmenting the market by geographic location, such as country or city.', 'C) Psychographic segmentation seeks to understand customers based on their lifestyle, key values, and activities.', 'D) Categorizing consumers based on their purchasing behavior and brand loyalty.'],
                'answer' => 'C'
            ],
            [
                'question' => 'How does social status affect market segmentation?',
                'choices' => ['A) Social status is only relevant in geographic segmentation and has no impact on consumer behavior.', 'B) Social status focuses on “how” people think and “what” they aspire their life to be based on their current position in life.', 'C) Social status determines a customer’s exact income level, which is the only factor in segmentation.', 'D) Market segmentation is only influenced by age and gender, not social status.'],
                'answer' => 'B'
            ],
            [
                'question' => 'How does lifestyle influence psychographic segmentation?',
                'choices' => ['A) Lifestyle is only about a person’s income and spending habits.', 'B) Lifestyle considers how people start and end their day, what they do on weekends, and how they spend their free time.', 'C) Lifestyle segmentation is based only on geographic location and climate.', 'D) Lifestyle has no impact on psychographic segmentation as it only considers demographics.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is behavioral segmentation?',
                'choices' => ['A) Dividing customers based on their geographic location and climate.', 'B) Categorizing consumers solely based on their age and gender.', 'C) Behavioral segmentation divides customers into segments based on their behavior patterns when interacting with a business.', 'D) Grouping customers based on their occupation and level of education.'],
                'answer' => 'C'
            ],
            [
                'question' => 'How do behavioral characteristics influence marketing?',
                'choices' => ['A) Behavioral characteristics have no impact on marketing strategies.', 'B) Behavioral characteristics influence shopping patterns and communication strategies.', 'C) Behavioral characteristics only determine a customer’s geographic location.', 'D) Marketing is only influenced by age and income, not behavior.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What are examples of behavioral segmentation?',
                'choices' => ['A) Grouping consumers based on their geographic region and climate preferences.', 'B) Examples of behavioral segmentation include buying on occasions, benefits sought, brand loyalty, and hype on sales promotions.', 'C) Categorizing customers by their education level and job industry.', 'D) Dividing consumers based only on their age and gender.'],
                'answer' => 'B'
            ],
            [
                'question' => 'How does the internet help in behavioral segmentation?',
                'choices' => ['A) With internet cookies, consumer behaviors can now be tracked and analyzed.', 'B) The internet has no impact on behavioral segmentation.', 'C) Behavioral segmentation is only possible through in-person surveys, not the internet.', 'D) The internet only helps in geographic segmentation, not behavioral segmentation.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is profiling in marketing?',
                'choices' => ['A) Grouping customers solely based on their income and occupation.', 'B) Profiling is the process of collecting only demographic data without analysis.', 'C) Marketing profiling is only used for geographic segmentation.', 'D) Profiling is describing the identified segment after segmentation to determine market size and customer needs.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is the purpose of profiling?',
                'choices' => ['A) Profiling is only used to collect customer names and contact details.', 'B) Profiling is only relevant for geographic segmentation and not for understanding customer behavior.', 'C) The two things to consider in profiling are the target market and the target audience profile.', 'D) Profiling randomly assigns customers to segments without analysis.'],
                'answer' => 'C'
            ],
            [
                'question' => 'Who are Hedonists?',
                'choices' => ['A) People who prioritize security, health, and family time over adventure and thrills.', 'B) Hedonists seek adventure, thrills, and fun. They pay attention to price, value status, and enjoy a good reputation. They are the first to buy new products and focus on quality over security, health, and family time.', 'C) Individuals who avoid new products and prefer traditional choices.', 'D) Consumers who focus only on practicality and never consider status or reputation.'],
                'answer' => 'B'
            ],
            [
                'question' => 'How do Hedonists behave as consumers?',
                'choices' => ['A) They avoid new products and prefer to wait until prices drop.', 'B) They only purchase necessities and do not care about trends or luxury.', 'C) Hedonists rarely spend money and prefer to save rather than indulge in new experiences.', 'D) Hedonists are willing to spend on new releases, such as lining up to buy the latest iPhone.'],
                'answer' => 'D'
            ],
            [
                'question' => 'Who are Traditionalists?',
                'choices' => ['A) Traditionalists value tradition, care about society and nature, prefer environmentally friendly products, and have their best experiences with family and friends.', 'B) People who constantly seek adventure and prioritize luxury over tradition.', 'C) Consumers who always buy the latest trends and do not focus on sustainability.', 'D) Individuals who disregard tradition and only make purchase decisions based on status.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What characteristics define Traditionalists?',
                'choices' => ['A) They are young, single, and prioritize trendy, fast-changing products over quality.', 'B) Traditionalists are slightly older, married, prefer friendly staff and after-sales support, and are willing to pay for quality.', 'C) Traditionalists dislike customer service interactions and only care about low prices.', 'D) They make impulsive purchases and rarely consider product longevity.'],
                'answer' => 'B'
            ],
            [
                'question' => 'How do Traditionalists behave as consumers?',
                'choices' => ['A) Traditionalists prefer sustainable choices, like buying naturally made products or using paper straws.', 'B) They prefer fast fashion and disposable products over sustainability.', 'C) Traditionalists always seek the cheapest option, regardless of environmental impact.', 'D) They prioritize technology and innovation over tradition and sustainability.'],
                'answer' => 'A'
            ],
            [
                'question' => 'How do Performers behave as consumers?',
                'choices' => ['A) They prioritize low-cost, basic products over quality and technology.', 'B) They avoid purchasing fitness-related products and focus only on luxury fashion.', 'C) Performers buy high-tech and well-designed products, such as an expensive but high-quality treadmill for their fitness needs.', 'D) Performers make impulsive purchases without considering quality or design.'],
                'answer' => 'C'
            ],
            [
                'question' => 'Who are Minimalists?',
                'choices' => ['A) People who seek luxury, frequently buy expensive items, and follow the latest trends.', 'B) Consumers who collect excessive amounts of products and prioritize quantity over necessity.', 'C) Minimalists prefer simplicity, only buy what they need, are very thrifty, care about their health, have low incomes, and are usually middle-aged and married.', 'D) Individuals who spend impulsively and focus more on social status than practicality.'],
                'answer' => 'C'
            ],
            [
                'question' => 'How do Minimalists behave as consumers?',
                'choices' => ['A) Minimalists, like housewives, prioritize affordable but high-quality products because they are mindful of their budget.', 'B) They frequently purchase luxury items without concern for cost.', 'C) They focus on collecting as many products as possible, regardless of necessity.', 'D) Minimalists are impulsive buyers who prefer trendy and expensive brands.'],
                'answer' => 'A'
            ],
            [
                'question' => 'How do women influence the market?',
                'choices' => [
                    'A) Women have little impact on the market since they do not participate in major purchasing decisions.',
                    'B) Women only influence markets related to fashion and cosmetics, not other industries.',
                    'C) Marketing strategies do not need to consider women\'s preferences, as they follow the same trends as men.',
                    'D) Women have high purchasing power as they are now part of the workforce. Product developers should not generalize women since each has different demands.'
                ],
                'answer' => 'D'
            ],
            [
                'question' => 'What is a buyer persona?',
                'choices' => ['A) A random customer profile without specific characteristics or research.A random customer profile without specific characteristics or research.', 'B) A buyer persona is a detailed description of a fictional person who represents the characteristics of the target audience.', 'C) A real person selected to represent an entire market segment.', 'D) A list of customer names and contact details used for advertising.'],
                'answer' => 'B'
            ],
            [
                'question' => 'Question: What is the purpose of creating a buyer persona?',
                'choices' => ['A) To collect random customer data without any specific strategy.', 'B) The purpose is to think about and communicate with this model customer as if they were real to better understand their needs.', 'C) To replace real customers with fictional ones in marketing research.', 'D) To generalize all customers into a single category without considering individual preferences.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is targeting in marketing?',
                'choices' => ['A) Targeting is the process of randomly selecting customers without segmentation.', 'B) Targeting means marketing to everyone equally without considering different customer needs.', 'C) Targeting is the process of choosing which segments to focus on after segmenting and profiling.', 'D) Targeting is only relevant for large businesses and not small enterprises.'],
                'answer' => 'C'
            ],
            [
                'question' => 'Why is targeting important?',
                'choices' => ['A) Targeting provides focus to the marketing plan by directing all marketing strategies to the chosen segment.', 'B) Targeting randomly distributes marketing efforts without a clear direction.', 'C) Targeting is unnecessary because all customers have the same needs.', 'D) Targeting only benefits large corporations and has no impact on small businesses.
    
    
    
    
    
    
    
    '],
                'answer' => 'A'
            ],
            [
                'question' => 'What is undifferentiated marketing?',
                'choices' => ['A) Undifferentiated marketing focuses on specific customer segments and tailors strategies for each.', 'B) Undifferentiated marketing uses different strategies for each demographic group but with the same message.', 'C) Undifferentiated marketing focuses only on luxury products for high-income customers.', 'D) Undifferentiated marketing considers the entire market as the target and adopts one marketing strategy.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is differentiated marketing?',
                'choices' => ['A) Differentiated marketing uses the same strategy for all market segments, with no distinction.', 'B) Differentiated marketing considers different segments in the market and uses separate marketing mix strategies for each.', 'C) Differentiated marketing targets only a single segment with a broad strategy.', 'D) Differentiated marketing is focused only on high-end, luxury products for a specific audience.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is a concentrated marketing strategy?',
                'choices' => ['A) A concentrated marketing strategy targets multiple segments with the same product and strategy.', 'B) A concentrated marketing strategy is when a business develops products for only one segment of the market.', 'C) A concentrated marketing strategy avoids focusing on any specific segment and targets everyone equally.', 'D) A concentrated marketing strategy focuses on offering only low-cost products to all segments.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is positioning in marketing?',
                'choices' => ['A) ', 'B) ', 'C) ', 'D) '],
                'answer' => ''
            ],
            [
                'question' => 'What is positioning in marketing?',
                'choices' => ['A) Positioning is how a product is priced based on the competition.', 'B) Positioning is how a product is placed in the market and perceived by consumers relative to competing products.', 'C) Positioning focuses solely on the product’s physical appearance and features.', 'D) Positioning is how a product is placed in the Concentrated Marketing Strategy.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is concentrated marketing strategy?',
                'choices' => ['A) In concentrated marketing, a business develops products for one segment of the market.', 'B) In concentrated marketing, a business targets multiple segments with the same product.', 'C) In concentrated marketing, a business avoids focusing on any specific market segment.', 'D) In concentrated marketing, a business offers a broad range of products to all market segments.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is positioning in marketing?',
                'choices' => ['A) Positioning is how you distribute your product to different regions.', 'B) Positioning is how you price your product based on production costs.', 'C) Positioning is how you position your product in the minds of your target market compared to other competitors in the market.', 'D) Positioning is how you place your product in retail stores and online platforms.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is perceptual mapping?',
                'choices' => ['A) Perceptual mapping is a method to track product sales over time.', 'B) Perceptual mapping is a tool used for pricing products in the market.', 'C) Perceptual mapping is a technique used to determine the best distribution channels for a product.
    
    
    
    
    
    
    
    ', 'D) Perceptual mapping is a visual display of how the target market perceives a product relative to its competitors.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What are the two types of markets?',
                'choices' => ['A) The two types of markets are the consumer or household market and the business market.', 'B) The two types of markets are the global market and the local market.', 'C) The two types of markets are the luxury market and the discount market.', 'D) The two types of markets are the product market and the service market.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is consumer behavior?',
                'choices' => ['A) Consumer behavior is the study of how businesses set prices for products.', 'B) Consumer behavior is the study of consumers and the processes they use in making purchasing decisions.', 'C) Consumer behavior is the process of designing products for specific target markets.', 'D) Consumer behavior is focused on how to advertise to large groups of people.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What cultural factors influence consumer behavior?',
                'choices' => ['A) Cultural factors include only the price of products and personal preferences.', 'B) Cultural factors are limited to the products popularity in the market.', 'C) Cultural factors include attitudes and beliefs, often influenced by parents, family, and society.', 'D) Cultural factors influence consumer behavior based solely on the availability of products.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What social factors influence consumer behavior?',
                'choices' => ['A) Social factors that influence behavior include reference groups, family, roles, and status.', 'B) Social factors include only the age and gender of consumers.', 'C) Social factors focus only on the income levels of consumers.', 'D) Social factors are related to the products manufacturing processes.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What personal factors influence consumer behavior?',
                'choices' => ['A) Personal factors such as only the income level and geographic location.', 'B) Personal factors are limited to a consumer’s preferences for specific brands.', 'C) Personal factors focus mainly on social class and cultural background.', 'D) Personal factors such as personality, age, life cycle stage, occupation, economic situation, lifestyle, and self-concept influence consumer behavior.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What psychological factors influence consumer behavior?',
                'choices' => ['A) Psychological factors include only the income and age of consumers.', 'B) Psychological factors like motivation, learning, perception, beliefs, and attitudes affect consumer behavior.', 'C) Psychological factors are limited to a consumer’s personal experiences with a product.', 'D) Psychological factors focus only on a consumer’s social relationships and peer influence.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is high involvement buying behavior?',
                'choices' => ['A) High involvement buying behavior occurs for small, everyday purchases like groceries', 'B) High involvement buying behavior involves quick, impulse purchases with little thought.', 'C) High involvement buying behavior occurs for large or expensive purchases, such as cars and houses.', 'D) High involvement buying behavior is limited to online shopping and e-commerce.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is low involvement buying behavior?',
                'choices' => ['A) Low involvement buying behavior occurs for large, expensive purchases like cars or houses.', 'B) Low involvement buying behavior happens for regular or small purchases, such as supermarket goods.', 'C) Low involvement buying behavior involves highly researched and planned purchases.', 'D) Low involvement buying behavior occurs only for luxury and high-end items.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is the marketing mix?',
                'choices' => ['A) The marketing mix consists of key elements involved in marketing a product or service to create an effective strategy.', 'B) The marketing mix consists of the pricing strategy and distribution channels only.', 'C) The marketing mix is focused only on product design and packaging.', 'D) The marketing mix is about selecting target markets and designing advertisements.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What are the 7P’s of marketing?',
                'choices' => ['A) Product, Price, Place, Promotion, People, Process, and Physical Evidence.', 'B) Product, Price, Place, Public Relations, People, Performance, and Packaging.', 'C) Product, Price, Place, Promotion, Packaging, Personalization, and Positioning.', 'D) Product, Price, Publicity, People, Process, Promotion, and Perception.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is a product in marketing?',
                'choices' => ['A) A product refers only to the physical items available for purchase in stores.', 'B) A product is only about the packaging and brand logo of an item.', 'C) A product refers to the functions, features, and benefits of a good or service that satisfy customer needs.', 'D) A product is the price consumers pay for a good or service.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is the augmented product?',
                'choices' => [
                    'A) The basic, core function of the product that satisfies a consumer\'s need.',
                    'B) The product\'s price after applying discounts and promotions.',
                    'C) The intangible benefits a customer gets from using the product, such as satisfaction.',
                    'D) The perceived value of a product before it is used.'
                ],
                'answer' => 'C' // Augmented product refers to additional benefits beyond core functions.
            ],
            [
                'question' => 'What is the actual product?',
                'choices' => ['A) The product itself, including its quality, design, and features.', 'B) The advertising and promotional strategies used to sell the product.', 'C) The packaging and distribution channels of the product.', 'D) The services or warranties provided alongside the product.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is the core product?',
                'choices' => ['A) The physical attributes and design of the product.', 'B) The main benefit or solution a product provides to the customer.', 'C) The marketing and promotional strategies used to sell the product.', 'D) The packaging and after-sales service that come with the product.'],
                'answer' => ''
            ],
            [
                'question' => 'What are the five stages of the product life cycle?',
                'choices' => ['A) Introduction, Growth, Maturity, Decline, and Innovation.', 'B) Development, Launch, Growth, Maturity, and Decline.', 'C) Planning, Design, Production, Distribution, and Sale.', 'D) Research, Testing, Launch, Peak, and End.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What happens during the development stage?',
                'choices' => ['A) Sales begin to increase as the product is introduced to the market.', 'B) The product starts to decline, and marketing strategies are reduced.', 'C) The product reaches its peak sales, and profits start to grow.', 'D) High costs with no sales as the product is being created.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What happens during the launch stage?',
                'choices' => ['A) Sales increase rapidly with minimal promotion costs.', 'B) The product reaches its peak, and competition starts to increase.', 'C) High promotion costs and low initial sales.', 'D) Profits grow while marketing costs are reduced.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What happens during the growth stage?',
                'choices' => ['A) Costs remain high while sales remain stagnant.', 'B) The product begins to lose market share.', 'C) Increasing sales and breaking even.', 'D) Sales start to decline while costs are minimized.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What happens during the maturity stage?',
                'choices' => ['A) Stable sales, high profit, and reduced promotion costs.', 'B) Rapid sales growth and constant innovation.', 'C) High costs and slow sales growth.', 'D) Product features are significantly altered to regain market share.'],
                'answer' => 'A'
            ],
            [
                'question' =>'  What happens during the decline stage?',
                'choices' => ['A) Sales continue to rise, and the market share increases.', 'B) Sales drop, requiring extension strategies or product withdrawal.', 'C) The product enters a stable market with little competition.', 'D) Profits increase while costs stay consistent.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is an extension strategy?',
                'choices' => ['A) A strategy to create completely new products for a different market.', 'B) A method to stop sales and withdraw the product from the market.', 'C) A strategy that focuses solely on lowering production costs.', 'D) A method used to maintain or increase sales and delay product decline.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What are examples of extension strategies?',
                'choices' => ['A) Modifying the product, reducing the price, adding features, or targeting a new market.', 'B) Increasing marketing expenses while maintaining the same product features.', 'C) Limiting product availability to make it exclusive.', 'D) Focused product innovation without considering market trends.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What factors influence the price of a product?',
                'choices' => ['A) Only the cost of production and profit margin.', 'B) Brand reputation and availability in the market.', 'C) Cost, profit margin, competitor pricing, and customer demand.', 'D) Government regulations and product packaging.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is the importance of pricing in marketing?',
                'choices' => ['A) Pricing affects customer perception, demand, and profitability.', 'B) Pricing only affects customer perception, not demand or profitability.', 'C) Pricing is only important for high-end luxury products.', 'D) Pricing does not influence the customer’s buying decision in any way.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is value-based pricing?',
                'choices' => ['A) Setting a price based on production costs.', 'B) Setting a price similar to competitors.', 'C) Setting a price based on the highest price a customer is willing to pay.', 'D) Setting a price based on customer perception of value.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is competitor-based pricing?',
                'choices' => ['A) Setting a price based on the cost of production and distribution.', 'B) Setting a price similar to competitors.', 'C) Setting a price based on the perceived value of the product.', 'D) Setting a price to reflect a unique value proposition.
    
    '],
                'answer' => 'B'
            ],
            [
                'question' => 'What is cost-plus pricing?',
                'choices' => ['A) Setting a price based on customer demand and trends.', 'B) Adding a profit margin to the cost of production.', 'C) Setting a price according to the competitor’s price.', 'D) Adding extra costs based on advertising and marketing.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is a price leader?
    ',
                'choices' => ['A) A business that dominates the market and sets prices.', 'B) A business that follows competitor pricing without changes.', 'C) A business that adjusts prices based on production costs only.', 'D) A business that offers the lowest prices in the industry.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is a price taker?',
                'choices' => ['A) A business that sets the industry standard for pricing.', 'B) A business that charges the highest price regardless of competition.', 'C) A business that ignores competitor pricing and sets its own prices freely.
    
    
    
    
    
    
    
    ', 'D) A business that follows the market price set by competitors.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is price skimming?',
                'choices' => ['A) Starting with a low price and gradually increasing it.', 'B) Setting a price equal to competitors from the start.', 'C) Launching with a high price and lowering it over time.', 'D) Keeping the same price regardless of demand.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is penetration pricing?',
                'choices' => ['A) Setting a low initial price to attract customers and increasing it later.', 'B) Starting with a high price and reducing it over time.', 'C) Setting a price based only on production costs.', 'D) Offering discounts without increasing the base price.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is competitive pricing?',
                'choices' => ['A) Setting the highest price in the market.', 'B) Matching or slightly undercutting competitor prices.', 'C) Ignoring competitor pricing and setting independent prices.', 'D) Always selling at a loss to compete.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is loss leader pricing?',
                'choices' => ['A) Selling at an extremely high price to maximize profits.', 'B) Setting the same price as competitors.', 'C) Pricing products with no profit margin but not at a loss.', 'D) Selling at a loss to attract customers to other profitable products.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is psychological pricing?',
                'choices' => ['A) Setting prices that seem lower, like ?39.99 instead of ?40.', 'B) Pricing based on customer negotiation.', 'C) Setting prices based only on product demand.', 'D) Charging different prices for different customer groups.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is promotion in marketing?',
                'choices' => ['A) Promotion is only about offering discounts to customers.', 'B) Promotion is the process of setting prices for products.', 'C) Promotion includes strategies to make consumers aware of a product or service.', 'D) Promotion focuses solely on designing the product packaging.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What are the aims of promotion?',
                'choices' => ['A) Reduce production costs while increasing inventory.', 'B) Raise awareness, encourage sales, create or change brand image, maintain market share, and increase market share.', 'C) Focus only on attracting new customers without retaining old ones.', 'D) Promote only when launching a new product, then stop marketing efforts.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is above-the-line promotion?',
                'choices' => ['A) Promotional methods that a company can directly control, like direct mail and sponsorships.', 'B) Promotions done only through in-store displays and sales staff.', 'C) A pricing strategy used to attract high-end customers.', 'D) Advertising using mass media that a company cannot directly control, like TV, radio, or newspapers.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is below-the-line promotion?',
                'choices' => ['A) Promotional methods that a company can directly control, like direct mail and sponsorships.', 'B) Promotions done only through in-store displays and sales staff.', 'C)  pricing strategy used to attract high-end customers.', 'D) Advertising using mass media that a company cannot directly control, like TV, radio, or newspapers.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What does AIDA stand for in marketing?',
                'choices' => ['A) Awareness, Information, Demand, Attraction.', 'B) Advertising, Investment, Distribution, Analysis.', 'C) Attention, Interest, Desire, Action.', 'D) Approach, Influence, Decision, Agreement.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is advertising?',
                'choices' => ['A) Directly selling products door-to-door.', 'B)  Promotion through TV, billboards, and the internet.', 'C) Only using email campaigns to promote a product.', 'D) Offering discounts as the main promotional strategy.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is sales promotion?',
                'choices' => ['A) Long-term brand-building through media advertisements.', 'B) Only promoting products through sponsorships.', 'C) Tactics like loyalty cards, discounts, and free gifts to encourage sales.', 'D) Setting high prices to increase perceived value.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is sponsorship?',
                'choices' => ['A) A business paying to be associated with another company, event, or cause.', 'B) A company directly controlling the prices of its competitors.', 'C) Only advertising through mass media.', 'D) A strategy used exclusively for launching new products.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is direct mailing?',
                'choices' => ['A) Advertising only through TV and radio.', 'B) A pricing strategy to attract budget-conscious customers.', 'C) Sending promotional materials via mail or email.', 'D) A method of reducing production costs.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is public relations (PR)?',
                'choices' => ['A) Offering price discounts to attract customers.', 'B) Setting product prices based on competitor analysis.', 'C) A method for developing new product designs.', 'D) Managing a company’s reputation and relationship with the public.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What is digital marketing?',
                'choices' => ['A) Traditional marketing using TV and billboards only.', 'B) Online promotion through social media, SEO, SEM, email, and digital ads.', 'C) A sales strategy focused only on in-person interactions.', 'D) A method that excludes paid advertisements.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is a promotional mix?',
                'choices' => ['A) A combination of different promotional activities used by businesses.', 'B) A pricing strategy to attract budget-conscious customers.', 'C) A method used only for digital marketing.', 'D) A process of setting production costs for a product.'],
                'answer' => 'A'
            ],
            [
                'question' => '',
                'choices' => ['A) ', 'B) ', 'C) ', 'D) '],
                'answer' => ''
            ],
            [
                'question' => 'What factors influence the promotional mix?',
                'choices' => ['A) Cost, target market, product, and competitors. ', 'B) Only the advertising budget of a company.', 'C) The color and design of a product’s packaging.', 'D) The availability of free samples in a store.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What is “place” in the marketing mix?',
                'choices' => ['A) The physical location where a business operates.', 'B) A strategy focused only on online sales.', 'C) The way a product or service is made accessible to consumers.', 'D) The process of setting product prices based on demand.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What are common places where products are sold?',
                'choices' => ['A) Only in physical retail stores.', 'B) Physical stores, mail orders, telesales, and the internet.', 'C) Exclusively through social media platforms.', 'D) Only in shopping malls and department stores.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is a channel of distribution?',
                'choices' => ['A) The physical location where a company operates.', 'B) The steps a product goes through from production to purchase.', 'C) A marketing strategy focused only on branding.', 'D) The process of setting product prices.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What is a jobber?',
                'choices' => ['A) A company that sells products directly to consumers.', 'B) A marketing tactic used for product promotions.', 'C) A salesperson who sells door-to-door.', 'D) A business that buys products from manufacturers and sells them to retailers.'],
                'answer' => 'D'
            ],
            [
                'question' => 'Why are people important in marketing?',
                'choices' => ['A) They only handle financial transactions.', 'B) They have no influence on marketing strategies.', 'C) They represent the business and impact customer experience.', 'D) They are only responsible for manufacturing products.'],
                'answer' => 'C'
            ],
            [
                'question' => 'How do employees affect a business’s image?',
                'choices' => ['A) Their training, knowledge, and behavior influence customer perception.', 'B) Their job is only to process orders without interacting with customers.', 'C) Their salaries determine how a company is perceived.', 'D) Their clothing choices have no impact on brand image.'],
                'answer' => 'A'
            ],
            [
                'question' => 'What does “process” refer to in marketing?',
                'choices' => ['A) The manufacturing of physical products.', 'B) The steps customers go through to access and consume a service.', 'C) A pricing strategy for premium products.', 'D) The location where a business operates.'],
                'answer' => 'B'
            ],
            [
                'question' => 'What are examples of processes in service marketing?',
                'choices' => ['A) Only the checkout process in physical stores. ', 'B) The design and color of product packaging.', 'C) Contact, reminders, registration, subscription, and form-filling.', 'D) Employee hiring and training.'],
                'answer' => 'C'
            ],
            [
                'question' => 'What is the physical environment in marketing?',
                'choices' => ['A) The online advertisements used for promotion.', 'B) A pricing strategy for physical products.', 'C) The location where a product is manufactured.', 'D) The ambience, mood, or physical presentation of the business that aligns with the product or service.'],
                'answer' => 'D'
            ],
            [
                'question' => 'What are examples of physical environment elements?',
                'choices' => ['A) Only the digital presence of a brand.', 'B) Packaging, websites, invoices, brochures, furnishings, uniforms, business cards, and the building itself.', 'C) The financial budget of a marketing campaign.', 'D) The internal communication system of a company.'],
                'answer' => 'B'
                ]
            ];

// Initialize variables
$selected_subject = $_POST['subject'] ?? null;
$questions = $selected_subject ? ($questions_by_subject[$selected_subject] ?? []) : [];
$total_questions = count($questions);
$score = null;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['start_quiz'])) {
    // Only set session if subject exists
    if (isset($subjects[$selected_subject])) {
        $_SESSION['selected_subject'] = $selected_subject;
        header("Refresh:0");
        exit();
    }
}

// Retrieve the selected subject from session after page reload
if (isset($_SESSION['selected_subject']) && isset($subjects[$_SESSION['selected_subject']])) {
    $selected_subject = $_SESSION['selected_subject'];
    $questions = $questions_by_subject[$selected_subject] ?? [];
}

// Handle quiz submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_quiz'])) {
    $score = 0;

    foreach ($questions as $index => $q) {
        $selected = $_POST['answer_' . $index] ?? '';
        if ($selected === $q['answer']) {
            $score++;
        }
    }

    // Save score to database
    $user_id = $_SESSION["user_id"];
    $quizController->saveScore($user_id, $score, $total_questions);

    // Store the score in session to display after reload
    $_SESSION['quiz_score'] = $score;
    $_SESSION['quiz_total'] = $total_questions;

    // Reload page
    header("Refresh:0");
    exit();
}

// Retrieve score from session
if (isset($_SESSION['quiz_score'])) {
    $score = $_SESSION['quiz_score'];
    $total_questions = is_array($questions) ? count($questions) : 0;


    // Clear session data
    unset($_SESSION['quiz_score'], $_SESSION['quiz_total']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz | ABM Revires</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
       <!-- Navbar -->
       <nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">ABM Revires</h1>
            <div class="space-x-6">
              <a href="dashboard" class="text-white hover:underline">Dashboard</a>
             <a href="Quiz" class="text-white hover:underline">Review quiz</a>
                <a href="flashcard" class="text-white hover:underline">review flashcard</a>
                <a href="sell-materials" class="text-white hover:underline">Sell Materials</a>
                <!-- <a href="/buy-material" class="text-white hover:underline">Buy Materials</a> -->
                <a href="notification" class="text-white hover:underline">Notification</a>
                <a href="leaderboard" class="text-white hover:underline">Leaderboard</a>
                <a href="logout" class="bg-red-500 px-4 py-2 rounded-lg text-white hover:bg-red-600">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800">Welcome, <?= $_SESSION["username"]; ?></h2>
        <p class="text-gray-600 mt-2">Select a subject to start the quiz:</p>

        <form method="POST" class="mt-4">  
        <label for="subject" class="block text-gray-700 font-semibold mb-2">Choose a subject:</label>  
        <select name="subject" id="subject" class="w-full p-2 border border-gray-300 rounded-lg">  
            <option value="">Select a subject</option>  
            <?php foreach ($subjects as $key => $value): ?>  
                <option value="<?= $key ?>" <?= $selected_subject === $key ? 'selected' : '' ?>><?= $value ?></option>  
            <?php endforeach; ?>  
        </select>  
        <button type="submit" name="start_quiz" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Start Quiz</button>  
    </form>  
</div>  

<?php if ($selected_subject && isset($subjects[$selected_subject]) && !empty($questions)): ?>  
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">  
        <h3 class="text-xl font-semibold text-gray-800">Quiz: <?= $subjects[$selected_subject] ?></h3>  
        <form method="POST" class="mt-4">  
            <?php foreach ($questions as $index => $q): ?>  
                <div class="mb-4">  
                <p class="font-medium"><?= (int)$index + 1 . ". " . $q['question'] ?></p>
 
                    <?php foreach ($q['choices'] as $choice): ?>  
                        <label class="block">  
                            <input type="radio" name="answer_<?= $index ?>" value="<?= substr($choice, 0, 1) ?>" required>  
                            <?= $choice ?>  
                        </label>  
                    <?php endforeach; ?>  
                </div>  
            <?php endforeach; ?>  
            <button type="submit" name="submit_quiz" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Submit Quiz</button>  
        </form>  
    </div>  
<?php endif; ?>  

<?php if ($score !== null): ?>  
    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">  
        <h3 class="text-xl font-semibold text-gray-800">Quiz Results</h3>  
        <p class="text-gray-700 mt-2">Your score: <strong><?= $score ?>/<?= $total_questions ?></strong></p>  
    </div>  
<?php endif; ?>  

</body>
</html>