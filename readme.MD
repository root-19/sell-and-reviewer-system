# Reviewer and Selling System

## 1. Introduction

This document outlines the development of a **Reviewer and Selling System**, which allows users to:

- Create an account
- Take quizzes and review flashcards
- Sell study materials
- Receive notifications
- View a leaderboard based on quiz scores

The system is developed using **PHP, HTML, and Tailwind CSS** within **Visual Studio Code**.

---

## 2. Features Overview

### **User Authentication**
- Users can register and log in to the system.
- After logging in, users are redirected to the dashboard.
- Users can log out, which redirects them to the registration page.

### **Dashboard Navigation**
The dashboard contains navigation links to:
- **Review** (Quiz and Flashcards)
- **Sell Study Materials**
- **Buy Study Materials**
- **Notifications**
- **Leaderboard**
- **Logout**

### **Review System (Quizzes & Flashcards)**
- Users can take quizzes, and their answers are stored in the database.
- Users can use flashcards for study purposes.
- Scores from quizzes and flashcards contribute to leaderboard ranking.

### **Selling Study Materials**
- Users can post study materials for sale from their dashboard.
- Posted materials are displayed for other users to purchase.
- Once sold, a notification is sent to the seller.
- The seller must accept the purchase for the transaction to be completed.

### **Buying Study Materials**
- Users can browse available study materials for purchase.
- After buying, the seller gets a notification and must accept the sale.

### **Notifications System**
- Users receive notifications if someone purchases their materials.
- Notifications appear in the notification section.

### **Leaderboard Ranking**
- The system stores all users' quiz and flashcard scores in the database.
- The total scores are calculated.
- The user with the highest score appears at the top of the leaderboard.

### **Logout Functionality**
- Users can log out from the system.
- After logout, they are redirected to the registration page.

---

## 3. System Flow

### **User Registration & Login**
1. User registers using a username, email, and password.
2. User logs in and is redirected to the dashboard.

### **Review System**
1. Users can answer quizzes, and scores are saved.
2. Users can use flashcards for studying.
3. Scores contribute to the leaderboard ranking.

### **Selling & Buying Study Materials**
1. Users can post study materials for sale.
2. Buyers can purchase materials.
3. Sellers get a notification and must accept the transaction.

### **Notifications**
1. If a material is purchased, the seller gets a notification.
2. The seller must approve the sale before the buyer gets access.

### **Leaderboard System**
1. All users' quiz and flashcard scores are recorded.
2. The system calculates the total score.
3. The top user appears first in the ranking.

### **Logout**
1. Users click Logout.
2. They are redirected to the registration page.

---

## 4. Technologies Used

- **Editor:** Visual Studio Code
- **Server:** XAMPP
- **Backend:** PHP, SQL
- **Frontend:** HTML, Tailwind CSS, JavaScript

---

## 5. Conclusion

This system provides a seamless experience for users who want to **review materials, sell study guides, and participate in quizzes**.  
It ensures that users receive notifications when transactions happen and maintains a **leaderboard** for quiz rankings.

---

