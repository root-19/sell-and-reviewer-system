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

$db = (new Database())->connect();
$quizController = new QuizController($db);

$subjects = [
    // 'Organizational Management' => 'Organizational Management',
    // 'Marketing' => 'Marketing',
    'Business Math' => 'Business Math',
    'Applied Economicst' => 'Applied Economicst',
    'Business Ethics' => 'Business Ethics'
];

$questions_by_subject = [
    'Business Math' => [
        [
            'question' => 'What does "markup" refer to in business?',
            'choices' => ['A) The amount added to the cost price to determine the selling price', 'B) The original price of a product before taxes', 'C) The amount deducted from the selling price', 'D) The total cost of production'],
            'answer' => 'A'
        ],
        [
            'question' => 'Which formula correctly represents the retail price with markup? ',
            'choices' => ['A) R = C - Mu', 'B) R = C + Mu', 'C) Mu = C × R', 'D) C = R + Mu'],
            'answer' => 'B'
        ],
        [
            'question' => 'A retailer buys a bag for P3,000 and sells it for P4,200. What is the markup amount?',
            'choices' => ['A) P1,000', 'B) P1,200', 'C) P1,500', 'D) P2,000'],
            'answer' => 'B'
        ],
        [
            'question' => 'If a store applies a 30% markup on an item that costs P5,000, what is the selling price?',
            'choices' => ['A) P5,500', 'B) P6,000', 'C) P6,500', 'D) P7,500'],
            'answer' => 'C'
        ],
        [
            'question' => 'Which business would most likely use markup pricing?',
            'choices' => ['A) A government office', 'B) A manufacturing plant', 'C) A retail clothing store', 'D) A bank'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the main reason businesses apply markdowns?',
            'choices' => ['A) To increase production costs', 'B) To attract customers and clear inventory', 'C) To make more profit per item', 'D) To increase taxes'],
            'answer' => 'B'
        ],
        [
            'question' => 'If a laptop originally costs P30,000 and is marked down to P24,000, what is the markdown amount?',
            'choices' => ['A) P5,000', 'B) P6,000', 'C) P7,000', 'D) P8,000'],
            'answer' => 'B'
        ],
        [
            'question' => 'A store reduces the price of a dress from P2,500 to P1,875. What is the markdown percentage?',
            'choices' => ['A) 15%', 'B) 20%', 'C) 25%', 'D) 30%'],
            'answer' => 'C'
        ],
        [
            'question' => 'A store wants to clear old stock by applying a 40% markdown on a P800 item. What is the new price?',
            'choices' => ['A) P320', 'B) P400', 'C) P480', 'D) P600'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the formula for calculating a new retail price after a markdown?',
            'choices' => ['A) R = C + Md', 'B) R = C × Md', 'C) R = C - Md', 'D) R = Md - C'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is a discount?',
            'choices' => ['A) A tax added to the selling price', 'B) A reduction from the original price', 'C) The profit a store makes', 'D) A penalty for late payments'],
            'answer' => 'B'
        ],
        [
            'question' => 'A television is originally priced at P50,000 and is on sale for 15% off. What is the discount amount?',
            'choices' => ['A) P5,000', 'B) P7,500', 'C) P8,000', 'D) P10,500'],
            'answer' => 'B'
        ],
        [
            'question' => 'The difference between a markdown and a discount is:',
            'choices' => ['A) A discount is deducted from the retail price, while a markdown is deducted from the original cost', 'B) A markdown is deducted from the retail price, while a discount is deducted from the original cost', 'C) They are the same thing', 'D) None of the above'],
            'answer' => 'A'
        ],
        [
            'question' => 'If a customer saves P900 on a 25% discount, what was the original price of the item?',
            'choices' => ['A) P3,200', 'B) P3,500', 'C) P3,600', 'D) P3,800'],
            'answer' => 'C'
        ],
        [
            'question' => 'What formula is used to find the discount amount?',
            'choices' => ['A) D = C × r', 'B) D = C - r', 'C) D = C + r', 'D) D = C ÷ r'],
            'answer' => 'A'
        ],
        [
            'question' => 'What happens when a business incurs more expenses than revenue?',
            'choices' => ['A) Profit', 'B) Loss', 'C) Break-even', 'D) Revenue growth'],
            'answer' => 'B'
        ],
        [
            'question' => ' A bakery sells 200 cupcakes at P50 each. The total expenses were P7,000. What is the profit?',
            'choices' => ['A) P2,000', 'B) P3,000', 'C) P5,000', 'D) P7,000'],
            'answer' => 'C'
        ],
        [
            'question' => 'A store sells a product for P1,200, but the cost to produce it is P900. What is the profit per item?',
            'choices' => ['A) P100', 'B) P200', 'C) P300', 'D) P400'],
            'answer' => 'C'
        ],
        [
            'question' => 'If a business earns P50,000 in revenue but has expenses of P45,000, what is the net profit?',
            'choices' => ['A) P3,000', 'B) P4,000', 'C) P5,000', 'D) P6,000'],
            'answer' => 'C'
        ],
        [
            'question' => 'What does "break-even" mean?',
            'choices' => ['A) The business makes a profit', 'B) The business has no profit or loss', 'C) The business suffers a loss', 'D) The business gains revenue but no expenses'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the break-even point?',
            'choices' => ['A) The point where expenses are higher than revenue', 'B) The point where revenue equals expenses', 'C) The point where the business makes maximum profit', 'D) The total amount of revenue'],
            'answer' => 'B'
        ],
        [
            'question' => 'A store sells a product for P150 and it costs P100 to make. If fixed costs are P10,000, how many units must be sold to break even?',
            'choices' => ['A) 100', 'B) 150', 'C) 200', 'D) 250'],
            'answer' => 'C'
        ],
        [
            'question' => 'If a company has expenses of P20,000 and earns revenue of P20,000, what is the net profit?',
            'choices' => ['A) P5,000', 'B) P2,500', 'C) P1,000', 'D) P0'],
            'answer' => 'D'
        ],
        [
            'question' => 'A bakery sells a cake for P500, and the cost to make one is P300. If rent and salaries total P40,000, how many cakes must be sold to break even?',
            'choices' => ['A) 80', 'B) 100', 'C) 120', 'D) 150'],
            'answer' => 'B'
        ],
        [
            'question' => 'Which formula is used to calculate the break-even point?',
            'choices' => ['A) BEP = Fixed Costs ÷ (Selling Price - Variable Cost)', 'B) BEP = Fixed Costs × Selling Price', 'C) BEP = Revenue - Expenses', 'D) BEP = (Revenue × Expenses) ÷ Profit'],
            'answer' => 'A'
        ],
        [
            'question' => 'This is a number written in the form, where a and b are whole numbers but b cannot be zero. The number is expressed as a quotient, in which the numerator is divided by the denominator.',
            'choices' => ['A) Decimal', 'B) Percentage', 'C) Fraction', 'D) Whole Number'],
            'answer' => 'C'
        ],
        [
            'question' => 'A fraction where the numerator is smaller than the denominator. Type of fraction: 1/2.',
            'choices' => ['A) Improper Fraction', 'B) Mixed Number', 'C) Proper Fraction', 'D) Whole Number'],
            'answer' => 'C'
        ],
        [
            'question' => 'A fraction where the numerator is greater than or equal to the denominator. Type of fraction: 6/5.',
            'choices' => ['A) Improper Fraction', 'B) Proper Fraction', 'C) Mixed Number', 'D) Unit Fraction'],
            'answer' => 'A'
        ],
        [
            'question' => 'A number that combines a whole number and a fraction. Type of fraction: 2¼.',
            'choices' => ['A) Improper Fraction', 'B) Proper Fraction', 'C) Unit Fraction', 'D) Mixed Number'],
            'answer' => 'D'
        ],
        [
            'question' => 'Fractions that have the same denominator. Type of fractions: ?, ?, ?.',
            'choices' => ['A) Similar Fractions', 'B) Dissimilar Fractions', 'C) Equivalent Fractions', 'D) Improper Fractions'],
            'answer' => 'A'
        ],
        [
            'question' => 'Fractions that have different denominators. Type of fractions: ?, ?, ?.',
            'choices' => ['A) Similar Fractions', 'B) Dissimilar Fractions', 'C) Equivalent Fractions', 'D) Improper Fractions'],
            'answer' => 'B'
        ],
        [
            'question' => 'The number on the top of a fraction and tells how many equal parts of a whole.',
            'choices' => ['A) Denominator', 'B) Whole Number', 'C) Numerator', 'D) Mixed Number'],
            'answer' => 'C'
        ],
        [
            'question' => 'The number on the bottom of a fraction and tells how many parts are in the whole.',
            'choices' => ['A) Denominator', 'B) Numerator', 'C) Whole Number', 'D) Mixed Number'],
            'answer' => 'A'
        ],
        [
            'question' => 'This is a fraction written in a special form. A representation of a fraction whose denominator is a multiple of 10.',
            'choices' => ['A) Decimal', 'B) Fraction', 'C) Whole Number', 'D) Mixed Number'],
            'answer' => 'A'
        ],
        [
            'question' => 'A number or ratio that can be expressed as a fraction of 100.',
            'choices' => ['A) Decimal', 'B) Fraction', 'C) Percentage', 'D) Ratio'],
            'answer' => 'C'
        ],
        [
            'question' => 'This refers to that number of which a certain number of hundredths is taken. What formula is this: B = P/R. A number on which a Rate is applied.',
            'choices' => ['A) Rate', 'B) Percentage', 'C) Ratio', 'D) Base'],
            'answer' => 'D'
        ],
        [
            'question' => '"20 is 40% of what number?" In the given example, identify the Rate.',
            'choices' => ['A) 20', 'B) 40%', 'C) 50', 'D) 100'],
            'answer' => 'B'
        ],
        [
            'question' => '"60 is ? of what number?" In the given example, identify the Percentage.',
            'choices' => ['A) 40', 'B) ?', 'C) 60', 'D) 90'],
            'answer' => 'C'
        ],
        [
            'question' => '25% of what number is 120?',
            'choices' => ['A) 240', 'B) 360', 'C) 480', 'D) 600'],
            'answer' => 'C'
        ],
        [
            'question' => 'Refers to the number of hundredths taken. What formula is this: R = P/B?',
            'choices' => ['A) Rate', 'B) Base', 'C) Percentage', 'D) Ratio'],
            'answer' => 'A'
        ],
        [
            'question' => '"5 is what percent of 20?" In the given example, identify the Percentage.',
            'choices' => ['A) 5', 'B) 20', 'C) 25%', 'D) 100%

'],
            'answer' => 'A'
        ],
        [
            'question' => '"75 is what percent of 150?" In the given example, identify the Base.',
            'choices' => ['A) 75', 'B) 50%', 'C) 225', 'D) 150'],
            'answer' => 'D'
        ],
        [
            'question' => '375 is what percent of 500?',
            'choices' => ['A) 50%', 'B) 75%', 'C) 60%', 'D) 80%'],
            'answer' => 'B'
        ],
        [
            'question' => 'This is the part considered in its quantitative relation to the whole. What formula is this: P = B × R?',
            'choices' => ['A) Base', 'B) Rate', 'C) Percentage', 'D) Ratio'],
            'answer' => 'C'
        ],
        [
            'question' => '"What is 40% of 300?" In the given example, identify the Base.',
            'choices' => ['A) 40%', 'B) 300', 'C) 500', 'D) 120'],
            'answer' => 'B'
        ],
        [
            'question' => '"? of 300 is what number?" In the given example, identify the Rate.

',
            'choices' => ['A) 200', 'B) 300', 'C) 450', 'D) ?'],
            'answer' => 'D'
        ],
        [
            'question' => 'What number is ? of 640?',
            'choices' => ['A) 400', 'B) 320', 'C) 500', 'D) 600'],
            'answer' => 'B'
        ],
        [
            'question' => 'What formula is this: (Q2 - Q1) / Q1?',
            'choices' => ['A) Percentage Formula', 'B) Base Formula', 'C) Rate of Increase and Decrease Formula', 'D) Ratio Formula'],
            'answer' => 'C'
        ],
        [
            'question' => 'Q1 represents the:',
            'choices' => ['A) New Quantity', 'B) Rate', 'C) Percentage', 'D) New Quantity'],
            'answer' => 'D'
        ],
        [
            'question' => 'Q2 represents the:',
            'choices' => ['A) New Quantity', 'B) Original Quantity', 'C) Rate', 'D) Percentage'],
            'answer' => 'A'
        ],
        [
            'question' => 'Zeny\'s current salary is ₱3,600 pesos a month. Her previous salary was ₱3,200. Identify the Q2 or New Quantity.',
            'choices' => ['A) ₱3,200', 'B) ₱3,400', 'C) ₱3,600', 'D) ₱4,000'],
            'answer' => 'C'
        ],        
      [ 
    'question' => 'Zeny\'s current salary is ₱3,600 pesos a month. Her previous salary was ₱3,200. Identify the Q2 or New Quantity.',
    'choices' => ['A) ₱3,200', 'B) ₱3,400', 'C) ₱3,600', 'D) ₱4,000'],
    'answer' => 'C'
    ],
        [
            'question' => 'The comparison between two numbers or quantities. Can be expressed in four ways and can be written as: Colon form (4:5), Division form (4÷5), Phrase form (4 to 5), and Fraction form (?).',
            'choices' => ['A) Proportion', 'B) Fraction', 'C) Percentage', 'D) Ratio'],
            'answer' => 'D'
        ],
        [
            'question' => '1 hour to 40 minutes, express the ratio in simplest form.',
            'choices' => ['A) 2/3 or 2:3', 'B) 4/5 or 4:5', 'C) 3/2 or 3:2', 'D) 5/4 or 5:4'],
            'answer' => 'C'
        ],        
        [
            'question' => '2 weeks to 4 days, express the ratio in simplest form.',
            'choices' => ['A) 3/1 or 3:1', 'B) 7/2 or 7:2', 'C) 2/5 or 2:5', 'D) 4/3 or 4:3'],
            'answer' => 'B'
        ],
        [
            'question' => 'Eight out of 30 passengers are tourists. Find the ratio of the tourists to the other passengers.',
            'choices' => ['A) 4/11 or 4:11', 'B) 8/30 or 8:30', 'C) 11/4 or 11:4', 'D) 3/2 or 3:2'],
            'answer' => 'A'
        ],
        [
            'question' => 'An equation that shows two ratios are equal. Can be written as a:b = c:d or a/b = c/d, where b ? 0, d ? 0. Two ratios can be simplified into the same ratio.',
            'choices' => ['A) Ratio', 'B) Proportion', 'C) Percentage', 'D) Fraction'],
            'answer' => 'B'
        ],
        [
            'question' => 'The first and fourth terms (a:b = c:d) in the proportion are called:',
            'choices' => ['A) Means', 'B) Extremes', 'C) Middle Terms', 'D) Equivalent Ratios'],
            'answer' => 'B'
        ],
        [
            'question' => 'The second and third terms (a:b = c:d) in the proportion are called:',
            'choices' => ['A) Means', 'B) Extremes', 'C) Equal Terms', 'D) Ratios'],
            'answer' => 'A'
        ],
        [
            'question' => 'The relation between two quantities where the ratio of the two is equal to a constant value. Two quantities are said to be in _________ if an increase in one also leads to an increase in the other quantity, and vice-versa.',
            'choices' => ['A) Inverse Proportions', 'B) Direct Proportions', 'C) Partitive Proportions', 'D) Equivalent Ratios'],
            'answer' => 'B'
        ],
        [
            'question' => 'If three notebooks cost ?15.00, how many notebooks can you buy with ?60.00?',
            'choices' => ['A) 9 notebooks', 'B) 10 notebooks', 'C) 12 notebooks', 'D) 15 notebooks'],
            'answer' => 'C'
        ],
        [
            'question' => 'The relationship between two quantities where one increases as the other decreases is called:',
            'choices' => ['A) Direct Proportions', 'B) Inverse/Indirect Proportions', 'C) Equivalent Proportions', 'D) Partitive Proportions'],
            'answer' => 'B'
        ],
        [
            'question' => 'If 8 painters need 30 days to paint a building, how many days do 24 painters need to paint a building?',
            'choices' => ['A) 8 days', 'B) 12 days', 'C) 15 days

', 'D) 10 days'],
            'answer' => 'D'
        ],
        [
            'question' => 'It involves identifying parts of a whole based on a given ratio of these parts. This is a way of dividing a whole amount into multiple parts that are not equal.',
            'choices' => ['A) Partitive Proportions', 'B) Direct Proportions', 'C) Inverse Proportions', 'D) Fractional Proportions'],
            'answer' => 'A'
        ],
        [
            'question' => 'A partnership agreement stipulates an agreed capitalization of ?100,000, and the partners are to divide the said capitalization in the ratio of 1:2:2. How much share capital does each partner get?',
            'choices' => ['A) ?10,000 : ?30,000 : ?60,000', 'B) ?25,000 : ?35,000 : ?40,000', 'C) ?20,000 : ?40,000 : ?40,000', 'D) ?15,000 : ?45,000 : ?40,000'],
            'answer' => 'C'
        ],
        [
            'question' => 'An important principle in the retail business. The proper pricing of its merchandise. The difference between the cost of the item and its selling price.',
            'choices' => ['A) Discount', 'B) Markup', 'C) Revenue', 'D) Profit'],
            'answer' => 'B'
        ],
        [
            'question' => 'The price that a merchant pays for an item.',
            'choices' => ['A) Selling price', 'B) Cost price', 'C) Markup', 'D) Discount price'],
            'answer' => 'B'
        ],
        [
            'question' => 'The price at which the commodity is sold per unit.',
            'choices' => ['A) Cost price', 'B) Wholesale price', 'C) Markup', 'D) Selling price'],
            'answer' => 'B'
        ],
        [
            'question' => 'The ratio of markup to its cost expressed in percent.',
            'choices' => ['A) Markup rate based on cost', 'B) Markup rate based on selling price', 'C) Discount rate', 'D) Profit margin'],
            'answer' => 'A'
        ],
        [
            'question' => 'The ratio of markup to its selling price expressed in percent.',
            'choices' => ['A) Markup rate based on cost', 'B) Markup rate based on selling price', 'C) Cost rate', 'D) Revenue rate'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the basic formula to get the Selling price?',
            'choices' => ['A) Selling price = Markup - Cost', 'B) Selling price = Markup × Cost', 'C) Selling price = Markup + Cost', 'D) Selling price = Cost - Markup'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the basic formula to get the Markup?',
            'choices' => ['A) Markup = Selling price - Cost', 'B) Markup = Selling price + Cost', 'C) Markup = Cost - Selling price', 'D) Markup = Cost × Selling price'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the basic formula to get the Cost?',
            'choices' => ['A) Cost = Selling price - Markup', 'B) Cost = Selling price + Markup', 'C) Cost = Markup - Selling price', 'D) Cost = Selling price × Markup'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula to get the Selling price on Markup on cost?',
            'choices' => ['A) Selling price = Cost - Markup', 'B) Selling price = Cost + Markup', 'C) Selling price = Cost ÷ Markup
', 'D) Selling price = Markup × Cost'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the formula to get the Rate on Markup on cost?',
            'choices' => ['A) Rate = Markup × Cost', 'B) Rate = Cost / Markup', 'C) Rate = Markup / Cost', 'D) Rate = Cost + Markup'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the formula to get the Cost on Markup on cost?',
            'choices' => ['A) Cost = Markup × Rate', 'B) Cost = Rate + Markup', 'C) Cost = Rate - Markup', 'D) Cost = Markup / Rate'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula to get the Markup on Markup on cost?',
            'choices' => ['A) Markup = Rate × Cost', 'B) Markup = Rate ÷ Cost', 'C) Markup = Cost - Rate', 'D) Markup = Cost + Rate'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula to get the Selling price on Markup on Selling price?',
            'choices' => ['A) Selling price = Markup - Rate', 'B) Selling price = Markup × Rate', 'C) Selling price = Markup / Rate', 'D) Selling price = Rate + Markup'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the formula to get the Rate on Markup on Selling price?',
            'choices' => ['A) Rate = Markup × Selling price', 'B) Rate = Markup + Selling price', 'C) Rate = Selling price ÷ Markup', 'D) Rate = Markup / Selling price'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula to get the Markup on Markup on Selling price?',
            'choices' => ['A) Markup = Rate × Selling Price', 'B) Markup = Rate ÷ Selling Price', 'C) Markup = Selling Price - Rate', 'D) Markup = Selling Price + Rate'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula to get the Markup Rate?',
            'choices' => ['A) rMU = Markup × Cost ÷ 100%', 'B) rMU = Markup / Cost × 100%', 'C) ', 'D) rMU = Markup + Cost × 100%'],
            'answer' => 'B'
        ],
        [
            'question' => 'The difference between the initial cost and the selling cost is called:',
            'choices' => ['A) Markup', 'B) Markon', 'C) Discount', 'D) Profit'],
            'answer' => 'B'
        ],
        [
            'question' => 'When does Markon usually happen?',
            'choices' => ['A) Regular sales', 'B) Clearance sales', 'C) Seasonal demands', 'D) Random price increases'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the formula for Markon?',
            'choices' => ['A) Markon = Initial Cost × Markon Rate', 'B) Markon = Initial Cost + Markon Rate', 'C) Markon = Initial Cost ÷ Markon Rate', 'D) Markon = Markon Rate - Initial Cost'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula for Markon Rate?',
            'choices' => ['A) Markon Rate = Initial Cost × Markon', 'B) Markon Rate = Initial Cost / Markon × 100', 'C) Markon Rate = Markon × Initial Cost / 100', 'D) Markon Rate = Markon / Initial Cost × 100'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula for Selling Price using Markon?',
            'choices' => ['A) Selling Price = Initial Cost - Markon', 'B) Selling Price = Initial Cost × Markon', 'C) Selling Price = Initial Cost + Markon', 'D) Selling Price = Markon - Initial Cost'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is obtained by getting the difference between the original selling price and the new selling price? It refers to reducing the original selling price.',
            'choices' => ['A) Markup', 'B) Markdown', 'C) Profit', 'D) Discount'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the formula for Markdown?',
            'choices' => ['A) Markdown = New Selling Price - Original Selling Price', 'B) Markdown = Original Selling Price × Markdown Rate', 'C) Markdown = Original Selling Price - New Selling Price', 'D) Markdown = Original Selling Price ÷ New Selling Price'],
            'answer' => 'C'
        ],
        [
            'question' => 'If the Markdown rate is given, what is the formula for Markdown?',
            'choices' => ['A) Markdown = Original Selling Price × Markdown Rate', 'B) Markdown = Original Selling Price ÷ Markdown Rate', 'C) Markdown = Original Selling Price - Markdown Rate', 'D) Markdown = New Selling Price × Markdown Rate'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula to get the New Selling Price using Markdown?',
            'choices' => ['A) New Selling Price = Original Selling Price × Markdown', 'B) New Selling Price = Original Selling Price + Markdown', 'C) New Selling Price = Original Selling Price - Markdown', 'D) New Selling Price = Markdown - Original Selling Price'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the formula for Markdown Rate?',
            'choices' => ['A) Markdown Rate = Markdown × Original Selling Price ÷ 100', 'B) Markdown Rate = Markdown ÷ Original Selling Price × 100', 'C) Markdown Rate = Original Selling Price ÷ Markdown × 100', 'D) Markdown Rate = Original Selling Price × Markdown ÷ 100'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is a profit based on selling price?',
            'choices' => ['A) Markup', 'B) Margin', 'C) Markdown', 'D) Discount'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is a profit based on cost?',
            'choices' => ['A) Markup', 'B) Margin', 'C) Revenue', 'D) Selling Price'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula for Margin Percentage?',
            'choices' => ['A) Margin Percentage = Markup × Selling Price ÷ 100', 'B) Margin Percentage = Selling Price / Markup × 100', 'C) Margin Percentage = Markup + Selling Price × 100', 'D) Margin Percentage = Markup / Selling Price × 100'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula for Markup Percentage?',
            'choices' => ['A) Markup Percentage = Markup × Cost ÷ 100', 'B) Markup Percentage = Markup + Cost × 100', 'C) Markup Percentage = Markup / Cost × 100', 'D) Markup Percentage = Cost / Markup × 100'],
            'answer' => 'C'
        ],
        [
            'question' => 'Reduction from the list price granted to buyers?',
            'choices' => ['A) Markup', 'B) Trade Discounts', 'C) Margin', 'D) Markdown'],
            'answer' => 'B'
        ],
        [
            'question' => 'What are the two types of discounts?',
            'choices' => ['A) Single and Series Discount', 'B) Trade and Bulk Discount', 'C) Seasonal and Markon Discount', 'D) Markdown and Promotional Discount'],
            'answer' => 'A'
        ],
        [
            'question' => 'What type of discount is given to a customer when they buy a product?',
            'choices' => ['A) Trade Discount', 'B) Single Discount', 'C) Series Discount', 'D) Promotional Discount'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is a multiple discount applied successively on the same item?',
            'choices' => ['A) Bulk Discount', 'B) Single Discount', 'C) Markdown', 'D) Series Discount'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the ratio of the discount and original retail cost called?',
            'choices' => ['A) Markup Rate', 'B) Discount Rate', 'C) Margin Rate', 'D) Selling Rate'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the selling price after the reduction of a discount on the List Price?',
            'choices' => ['A) Discounted Price', 'B) New Selling Price', 'C) Markon Price', 'D) Retail Price'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the original selling price called?',
            'choices' => ['A) List Price', 'B) New Selling Price', 'C) Discount Price', 'D) Trade Price'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula for Single Discount?',
            'choices' => ['A) Discount = List Price ÷ Discount Rate', 'B) Discount = List Price - Discount Rate', 'C) Discount = Discount Rate × New Selling Price', 'D) Discount = List Price × Discount Rate'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula for New Selling Price when the discount is given?',
            'choices' => ['A) New Selling Price = List Price + Discount', 'B) New Selling Price = List Price × Discount', 'C) New Selling Price = List Price - Discount', 'D) New Selling Price = Discount - List Price'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the formula for Series Discount?',
            'choices' => ['A) Selling Price = (1 + r1)(1 + r2).... (1 + rn)C', 'B) Selling Price = (1 - r1)(1 - r2).... (1 - rn)C', 'C) Selling Price = C ÷ (1 - r1)(1 - r2).... (1 - rn)', 'D) Selling Price = C × r1 × r2 × rn'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the formula for Discount Rate?',
            'choices' => ['A) Discount Rate = Discount × Original Retail Cost', 'B) Discount Rate = Original Retail Cost ÷ Discount', 'C) Discount Rate = Original Retail Cost - Discount', 'D) Discount Rate = Discount / Original Retail Cost'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the amount left from the revenue after all costs and expenses have been deducted?',
            'choices' => ['A) Revenue', 'B) Profit', 'C) Loss', 'D) Expense'],
            'answer' => 'B'
        ],
        [
            'question' => 'What occurs when the cost and expenses exceed the revenue or sales?',
            'choices' => ['A) Profit', 'B) Gain', 'C) Loss', 'D) Markup'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula for Profit or Loss?',
            'choices' => ['A) Profit/Loss = Revenue × Operating Expense', 'B) Profit/Loss = Revenue ÷ Operating Expense', 'C) Profit/Loss = Operating Expense - Revenue', 'D) Profit/Loss = Revenue - Operating Expense'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the formula to determine Expenses in Profit/Loss calculation?',
            'choices' => ['A) Expenses = Cost × Number of products created', 'B) Expenses = Cost ÷ Number of products created', 'C) Expenses = Cost + Number of products created', 'D) Expenses = Cost - Number of products created'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the formula to determine Revenue in Profit/Loss calculation?',
            'choices' => ['A) Revenue = Selling Price ÷ Number of Products Sold', 'B) Revenue = Selling Price - Number of Products Sold', 'C) Revenue = Selling Price × Number of Products Sold', 'D) Revenue = Selling Price + Number of Products Sold'],
            'answer' => 'C'
        ],
    ],

        'Applied Economicst' => [
        [
            'question' => 'According to him, economics is the proper allocation and efficient use of available resources for the maximum satisfaction of human wants.',
            'choices' => ['A) Fajardo', 'B) Sicat', 'C) Nordhaus', 'D) Webster'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the Greek word for economics?',
            'choices' => ['A) Oikos', 'B) Oikonomia', 'C) Oikonomiko', 'D) Oikonomika'],
            'answer' => 'B'
        ], 
        [
            'question' => 'It is a social science that involves the use of scarce resources to satisfy unlimited wants.',
            'choices' => ['A) Management', 'B) Scarcity', 'C) Allocation', 'D) Economics'],
            'answer' => 'D'
        ],
        [
            'question' => 'Economics is the science of choice. Whose perspective is this?',
            'choices' => ['A) Fajardo', 'B) Sicat', 'C) Nordhaus', 'D) Webster'],
            'answer' => 'C'
        ],
        [
            'question' => 'The limited nature of resources, which underlies the basic economic problem.',
            'choices' => ['A) Management', 'B) Scarcity ', 'C) Allocation', 'D) Economics '],
            'answer' => 'B'
        ],
        [
            'question' => 'It is the essential of life, such as food and shelter.',
            'choices' => ['A) Resources', 'B) Desires', 'C) Needs', 'D) Wants'],
            'answer' => 'C'
        ],
        [
            'question' => 'The efforts of people involved in production, including labour and entrepreneurship.',
            'choices' => ['A) Human Resources', 'B) Capital Resources', 'C) Economic Resources', 'D) Natural Resources'],
            'answer' => 'A'
        ],
        [
            'question' => 'These are desires for non-essential items.',
            'choices' => ['A) Resources', 'B) Desires', 'C) Needs', 'D) Wants'],
            'answer' => 'D'
        ],
        [
            'question' => 'Refers to the process of producing or creating goods needed by the households to satisfy their needs.',
            'choices' => ['A) Development', 'B) Marketing', 'C) Production', 'D) Management'],
            'answer' => 'C'
        ],
        [
            'question' => 'Person or business that buys or uses goods or services.',
            'choices' => ['A) Producer', 'B) Consumer', 'C) Worker', 'D) Entrepreneur'],
            'answer' => 'B'
        ],
        [
            'question' => 'The application of economic theory and econometrics in the real world situation',
            'choices' => ['A) Household Management', 'B) Business Administration', 'C) Marketing Management', 'D) Applied Economics'],
            'answer' => 'D'
        ],
        [
            'question' => 'The ability to provide for basic needs like food, shelter, health, and protection.',
            'choices' => ['A) Sustenance', 'B) Quality of life', 'C) Self-esteem', 'D) Freedom'],
            'answer' => 'A'
        ],
        [
            'question' => 'This assumes that individuals act in a logical and predictable manner and pursue goals which will benefit them.',
            'choices' => ['A) Profit Maximization', 'B) Rationality', 'C) Perfect Information', 'D) Ceteris Paribus'],
            'answer' => 'B'
        ],
        [
            'question' => 'A fallacy referring to a statement that oversimplifies a specific scenario presenting as a general rule.',
            'choices' => ['A) Sweeping Generalization', 'B) Post Hoc Fallacy', 'C) Fallacy of Composition', 'D) Failure to hold things constant under ceteris paribus'],
            'answer' => 'A'
        ],
        [
            'question' => 'Assumes that consumers and producers have complete and accurate information about product, services, prices, utility, quality, and production methods.',
            'choices' => ['A) Profit Maximization', 'B) Rationality', 'C) Perfect Information', 'D) Ceteris Paribus'],
            'answer' => 'C'
        ],
        [
            'question' => 'Error in analysis committed when an individual considers other extraneous variables in studying an economic phenomenon.',
            'choices' => ['A) Sweeping Generalization', 'B) Post Hoc Fallacy', 'C) Fallacy of Composition', 'D) Failure to hold things constant under ceteris paribus'],
            'answer' => 'D'
        ],
        [
            'question' => 'The gap between voluntarily leaving a job and finding another.',
            'choices' => ['A) Frictional Unemployment', 'B) Seasonal Unemployment', 'C) Structural Unemployment', 'D) Underemployment'],
            'answer' => 'A'
        ],
        [
            'question' => 'Refers to a slow economic growth, with high unemployment.',
            'choices' => ['A) Inflation', 'B) Consumer Price Index', 'C) Stagflation', 'D) Hyperinflation'],
            'answer' => 'C'
        ],
        [
            'question' => 'A mismatch between the skills that can offer and skills demanded.',
            'choices' => ['A) Frictional Unemployment', 'B) Structural Unemployment', 'C) Seasonal Unemployment', 'D) Underemployment'],
            'answer' => 'B'
        ],
        [
            'question' => 'High inflation that could result in several negative effects.',
            'choices' => ['A) Inflation', 'B) Consumer Price Index', 'C) Stagflation', 'D) Hyperinflation'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is the meaning of POLC in economics?',
            'choices' => ['A) Planning, Organizing, Leading, Controlling.', 'B) Pricing, Operations, Logistics, Capital.', 'C) Production, Output, Labor, Costs.', 'D) Profit, Optimization, Leverage, Competition.'],
            'answer' => 'A'
        ],
        [
            'question' => 'These came from nature that are used in production, including land, raw materials, and natural processes.',
            'choices' => ['A) Human Capital', 'B) Financial Assets', 'C) Natural Resources', 'D) Manufactured Goods'],
            'answer' => 'C'
        ],
        [
            'question' => 'It is when a good is scarce compared to its demand.',
            'choices' => ['A) Surplus', 'B) Relative Scarcity', 'C) Market Equilibrium', 'D) Abundance'],
            'answer' => 'B'
        ],
        [
            'question' => 'The value of the best foregone alternative.',
            'choices' => ['A) Sunk Cost', 'B) Fixed Cost', 'C) Marginal Cost', 'D) Opportunity Cost'],
            'answer' => 'D'
        ],
        [
            'question' => 'Deals with the economic behavior of the whole economy or its aggregates (composed of individual units).',
            'choices' => ['A) Macroeconomics', 'B) Microeconomics', 'C) Market Economy', 'D) Managerial Economics'],
            'answer' => 'A'
        ],
        [
            'question' => 'The blood of business',
            'choices' => ['A) Financial Accounting', 'B) Human Resources', 'C) Marketing Management', 'D) Operations Management'],
            'answer' => 'C'
        ],
        [
            'question' => 'Person or business that makes goods or provides services.',
            'choices' => ['A) Consumer', 'B) Distributor', 'C) Producer ', 'D) Retailer'],
            'answer' => 'C'
        ],
        [
            'question' => 'Refers to the dollar and dollar reserves that the economy has.',
            'choices' => ['A) Trade Balance', 'B) Gross Domestic Product', 'C) Foreign Exchange', 'D) Inflation Rate'],
            'answer' => 'D'
        ],
        [
            'question' => 'Something you can see, feel, and use.',
            'choices' => ['A) Services', 'B) Goods ', 'C) Labor', 'D) Capital'],
            'answer' => 'B'
        ],
        [
            'question' => 'Also called  human resources. ',
            'choices' => ['A) Land', 'B) Capital', 'C) Entrepreneurship', 'D) Labor'],
            'answer' => 'C'
        ],
        [
            'question' => 'Something done for someone else.',
            'choices' => ['A) Goods', 'B) Land', 'C) Services', 'D) Labor'],
            'answer' => 'C'
        ],
        [
            'question' => 'It is when supply is limited.',
            'choices' => ['A) Opportunity Cost', 'B) Absolute Scarcity', 'C) Demand', 'D) Production'],
            'answer' => 'B'
        ],
        [
            'question' => 'Considered an economic resource because it has a price attached to it, paid through rent or lease.',
            'choices' => ['A) Land', 'B) Capital', 'C) Labor', 'D) Services'],
            'answer' => 'A'
        ],
        [
            'question' => 'The sustained elevation of an entire society and social system towards a better, more human life.',
            'choices' => ['A) Economic Growth', 'B) Economic Development', 'C) Social Progress', 'D) Industrialization'],
            'answer' => 'B'
        ],
        [
            'question' => 'The example of this is when taxes enable the government to provide services to the people.',
            'choices' => ['A) Normative Economics', 'B) Positive Economics', 'C) Economic Policy', 'D) Public Finance'],
            'answer' => 'B'
        ],
        [
            'question' => ' All other things being equal. ',
            'choices' => ['A) Opportunity Cost', 'B) Marginal Analysis', 'C) Ceteris Paribus', 'D) Market Equilibrium'],
            'answer' => 'C'
        ],
        [
            'question' => 'Assumes that individuals aim to maximize utility, while firms intend to maximize their profit.',
            'choices' => ['A) Supply and Demand', 'B) Market Equilibrium', 'C) Cost-Benefit Analysis', 'D) Profit Maximization'],
            'answer' => 'D'
        ],
        [
            'question' => 'Fallacy that considers a trait of one part of an aspect of something as true or applicable for the whole.',
            'choices' => ['A) Fallacy of Composition', 'B) Post Hoc Fallacy', 'C) Circular Reasoning', 'D) Ad Hominem'],
            'answer' => 'A'
        ],
        [
            'question' => 'Describes how people make the mistaken notion since a change happened after an event.',
            'choices' => ['A) Correlation Fallacy', 'B) Post Hoc Fallacy', 'C) False Dilemma', 'D) Gambler s Fallacy'],
            'answer' => 'B'
        ],
        [
            'question' => 'A graph that shows the greatest sum of outputs given accessible inputs or resources in an economy.',
            'choices' => ['A) Supply and Demand Curve', 'B) Business Cycle', 'C) Production Possibilities Frontier', 'D) Market Equilibrium'],
            'answer' => 'C'
        ],
        [
            'question' => 'Another significant aspect of economic development that has to be considered in an interconnected global economy.',
            'choices' => ['A) International Trade', 'B) Domestic Production', 'C) Labor Force', 'D) Infrastructure Development'],
            'answer' => 'A'
        ],
        [
            'question' => 'Low production and low standard of living.',
            'choices' => ['A) Economic Decline', 'B) Underdevelopment', 'C) Recession', 'D) Recession'],
            'answer' => 'B'
        ],
        [
            'question' => 'Unemployment when the season ends.',
            'choices' => ['A) Cyclical Unemployment', 'B) Frictional Unemployment', 'C) Seasonal Unemployment', 'D) Structural Unemployment'],
            'answer' => 'C'
        ],
        [
            'question' => 'Lack of paid work or work that makes full use of skills/abilities.',
            'choices' => ['A) Unemployment', 'B) Job Deficit', 'C) Underemployment', 'D) Labor Force Dropout'],
            'answer' => 'C'
        ],
        [
            'question' => 'Statistical estimate based on the price of selected commodities purchased by households.',
            'choices' => ['A) Inflation Rate', 'B) Purchasing Power Parity', 'C) Market Basket Index', 'D) Consumer Price Index'],
            'answer' => 'D'
        ],
        [
            'question' => 'This variable considers each aspect in life.',
            'choices' => ['A) Quality of Life', 'B) Cost of Living', 'C) Human Development Index', 'D) Economic Mobility'],
            'answer' => 'A'
        ],
        [
            'question' => 'Increases gross domestic product.',
            'choices' => ['A) Consumer Spending', 'B) Level of Production', 'C) Interest Rates', 'D) Population Growth'],
            'answer' => 'B'
        ],
        [
            'question' => 'M s in Operations Management',
            'choices' => ['A) Money, Market, Management, Method, Man', 'B) Materials, Money, Machine, Man, Methods', 'C) Market, Motivation, Machinery, Measure, Model', 'D) Manpower, Movement, Measurement, Methodology, Money'],
            'answer' => ''
        ],

     ],
     'Business Ethics' => [
        [
            'question' => 'What is the primary role of business in society?',
            'choices' => ['A) To maximize profit', 'B) To provide goods and services', 'C) To accumulate wealth', 'D) All of the above'],
            'answer' => 'D'
        ],
        [
            'question' => 'What does the word "ethics" derived from?',
            'choices' => ['A) Latin word "mores"', 'B) Greek word "ethos"', 'C) Both A and B', 'D) Neither A nor B'],
            'answer' => 'C'
        ],
        [
            'question' => 'Which of the following defines "ethics"?',
            'choices' => ['A) Rules from an individual’s perspective', 'B) Rules provided by an external source', 'C) An individual’s own principle regarding right and wrong', 'D) An organization’s internal conduct standards'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does violating ethical rules often result in?',
            'choices' => ['A) Personal guilt and shame', 'B) Societal consequences', 'C) Promotion', 'D) Happiness'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the difference between ethics and morals?',
            'choices' => ['A) Ethics are self-imposed, while morals are externally imposed', 'B) Ethics refer to institutional rules, while morals are personal principles', 'C) Ethics are subjective, while morals are objective', 'D) There is no difference between them'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is business ethics?',
            'choices' => ['A) The ethical standards that guide personal conduc', 'B) The principles that regulate behavior in a professional context', 'C) The moral guidelines for government officials', 'D) None of the above'],
            'answer' => 'B'
        ],
        [
            'question' => 'Who are stakeholders in business?',
            'choices' => ['A) Only the business owners', 'B) Only the customers', 'C) Individuals and entities affected by business decisions', 'D) Only employees'],
            'answer' => 'C'
        ],
        [
            'question' => 'Why is ethics important in organizations?',
            'choices' => ['A) It helps improve the business reputation', 'B) It boosts consumer confidence', 'C) It builds a positive corporate culture', 'D) All of the above'],
            'answer' => 'D'
        ],
        [
            'question' => 'Which of the following statements aligns with Seth Godin’s perspective on business?',
            'choices' => ['A) "Find customers for your products."', 'B) "Find products for your customers."', 'C) "Focus on profit maximization."', 'D) "Sell what is easiest to produce."'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is honesty in business ethics?',
            'choices' => ['A) The act of following all the rules', 'B) The act of following all the rules', 'C) Seeking to accumulate wealth at any cost', 'D) Competing aggressively in the market'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does integrity in business refer to?',
            'choices' => ['A) Maintaining a flexible stance in decision-making', 'B) Consistently acting according to ethical or moral principles', 'C) Favoring personal interests over company interests', 'D) Avoiding conflict at all costs'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does the principle of "keeping promises" emphasize?',
            'choices' => ['A) Saying yes to every business proposal', 'B) Fulfilling commitments and promises made to others', 'C) Ignoring minor responsibilities', 'D) Relying on other people to fulfill promises'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does loyalty in the workplace imply?',
            'choices' => ['A) Sticking with someone even when it conflicts with self-interest', 'B) Always agreeing with your boss', 'C) Seeking to benefit yourself above the organization', 'D) Ignoring workplace responsibilities'],
            'answer' => 'A'
        ],
        [
            'question' => 'Fairness in business means:',
            'choices' => ['A) Giving preferential treatment to the best performers', 'B) Treating people based on standards that are equal and consistent', 'C) Following laws strictly without question', 'D) Focusing on high profits at any cost'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does the principle of "caring" involve in a business context?',
            'choices' => ['A) Focusing solely on profit generation', 'B) Competing aggressively against others', 'C) Demonstrating compassion and concern for others', 'D) Ignoring employee well-being'],
            'answer' => 'C'
        ],
        [
            'question' => 'Why is respect crucial in the workplace?',
            'choices' => ['A) It helps in building a positive corporate culture', 'B) It encourages better productivity', 'C) It creates a healthy environment for everyone’s ideas and opinions', 'D) All of the above'],
            'answer' => 'D'
        ],
        [
            'question' => 'Obeying the law in business means:',
            'choices' => ['A) Ignoring minor legal issues', 'B) Following all rules and regulations that affect business operations', 'C) Prioritizing personal benefits over legal obligations', 'D) Avoiding difficult decisions'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does "excellence" in the workplace refer to?',
            'choices' => ['A) Meeting the minimum expected standards', 'B) Surpassing expectations and striving for continuous improvement', 'C) Focusing on speed rather than quality', 'D) Prioritizing cost-cutting over quality'],
            'answer' => 'B'
        ],
        [
            'question' => 'Prioritizing cost-cutting over quality',
            'choices' => ['A) Delegating all responsibilities to others', 'B) Supervising and motivating others to achieve the company’s goals', 'C) Focusing solely on personal career advancement', 'D) Avoiding difficult decisions'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does accountability in the workplace mean?',
            'choices' => ['A) Taking responsibility for your actions, performance, and decisions', 'B) Avoiding responsibility for mistakes', 'C) Blaming others for personal failures', 'D) Taking credit for all successes'],
            'answer' => 'A'
        ],
        [
            'question' => 'What are the four roles of business in society?',
            'choices' => ['A) Wealth Accumulation, Consumerism, Resource Exploitation, and Profit Maximization', 'B) Economic Development, Provision of Goods and Services, Social Contribution, and Empowering Individuals', 'C) Market Control, Employment Reduction, Digitalization, and Trade Restriction', 'D) Industrialization, Automation, Investment Diversification, and Supply Chain Expansion'],
            'answer' => 'B'
        ],
        [
            'question' => 'What does the Greek word "ethos" mean?',
            'choices' => ['A) Culture', 'B) Habit', 'C) Character', 'D) Morality'],
            'answer' => 'C'
        ],
        [
            'question' => 'What is the difference between ethics and morals?',
            'choices' => ['A) Ethics are personal beliefs, while morals are laws enforced by the government.', 'B) Ethics are rules provided by an external source, while morals are an individual’s principles of right and wrong.', 'C) Ethics and morals are the same and can be used interchangeably.', 'D) Ethics focus only on business, while morals apply only to personal life.'],
            'answer' => 'B'
        ],
        [
            'question' => 'What is the main purpose of business ethics?',
            'choices' => ['A) To maximize profit regardless of ethical concerns.', 'B) To enforce strict government laws on businesses.', 'C) To focus only on customer satisfaction without considering ethical standards.', 'D) To examine ethical principles and moral problems that arise in a business environment.'],
            'answer' => 'D'
        ],
        [
            'question' => 'Name three benefits of ethics in an organization.',
            'choices' => ['A) Builds a positive corporate culture, boosts consumer confidence, and improves business reputation.', 'B) Increases employee stress, reduces accountability, and promotes secrecy.', 'C) Focuses only on profit, disregards social responsibility, and weakens company trust.', 'D) Encourages unethical competition, reduces customer loyalty, and avoids transparency.'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is an ethical dilemma in business?',
            'choices' => ['A) A situation where businesses always follow legal regulations without any issues.', 'B) A strategy used to maximize profits without considering ethics.', 'C) A situation where a business decision conflicts with ethical standards.', 'D) A decision-making process that only focuses on financial growth.'],
            'answer' => 'D'
        ],
        [
            'question' => 'What is whistleblowing?',
            'choices' => ['A) The act of exposing illegal or unethical activity within an organization.', 'B) A strategy used to promote a company’s products.', 'C) Reporting only financial issues to upper management.', 'D) Ignoring unethical behavior to maintain job security.'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is the significance of honesty in business ethics?',
            'choices' => ['A) It ensures businesses can avoid all legal consequences.', 'B) It allows businesses to manipulate customers more effectively.', 'C) It fosters trust, integrity, and fairness in business practices.', 'D) It has no real impact on an organization’s success.'],
            'answer' => 'C'
        ],
        [
            'question' => 'How does a company maintain fairness in business?',
            'choices' => ['A) By prioritizing profits over employee well-being.', 'B) By offering promotions only to senior employees.', 'C) By setting different rules for different customers.', 'D) By treating people equally, ensuring a non-discriminatory environment, and respecting others’ interests.'],
            'answer' => 'D'
        ],
        [
            'question' => 'Integrity',
            'choices' => ['A) The ability to persuade others using charm and charisma.', 'B) The quality of having strong ethical or moral principles and consistently adhering to them.', 'C) The act of adapting to different situations without a set moral code.', 'D) The practice of putting personal gain above ethical considerations.'],
            'answer' => 'B'
        ],
        [
            'question' => 'Stakeholders',
            'choices' => [
                'A) Individuals or entities affected by a business’s decisions.', 
                'B) People who manage a company\'s financial accounts.', 
                'C) Employees who work only in upper management positions.', 
                'D) Competitors who try to take over a business.'
            ],
            'answer' => 'A'
        ],
        [
            'question' => 'Corporate Social Responsibility (CSR)',
            'choices' => ['A) The process of maximizing profits without considering ethical concerns.', 'B) A government policy that regulates corporate taxes and expenditures.', 'C) A strategy used by businesses to avoid legal responsibilities.', 'D) A company’s commitment to ethical practices and social contribution beyond profit-making.'],
            'answer' => 'D'
        ],
        [
            'question' => 'Conflict of Interest',
            'choices' => ['A) A disagreement between two business partners over profits.', 'B) A disagreement between two business partners over profits.', 'C) A situation where personal interests clash with professional responsibilities.', 'D) A strategy used to improve workplace relationships.'],
            'answer' => 'C'
        ],
        [
            'question' => 'Overpricing',
            'choices' => ['A) Setting a price lower than the value of a product to increase sales.', 'B) Selling a product at its manufacturing cost.', 'C) Setting a price higher than the actual value of a product or service.', 'D) Offering discounts to attract more customers.'],
            'answer' => 'C'
        ],
        [
            'question' => 'Misleading Advertisement',
            'choices' => ['A) A promotional campaign that accurately describes a product’s features.', 'B) False or deceptive advertising that misrepresents a product or service.', 'C) A marketing strategy that uses celebrity endorsements.', 'D) A legal requirement for companies to disclose product ingredients.'],
            'answer' => 'B'
        ],
        [
            'question' => 'Layoff',
            'choices' => ['A) Temporary or permanent termination of employment due to business reasons.', 'B) The process of promoting employees to higher positions.', 'C) A voluntary resignation by an employee.', 'D) A reward system for employees who meet their targets.'],
            'answer' => 'A'
        ],
        [
            'question' => 'Professional Ethics',
            'choices' => ['A) Personal morals that individuals follow in their daily lives.', 'B) Guidelines used only for marketing strategies.', 'C) Ethical standards imposed by a profession, often exceeding legal requirements.', 'D) A company’s financial policies and regulations.'],
            'answer' => 'C'
        ],
        [
            'question' => 'Caring in Business Ethics',
            'choices' => ['A) Exercising compassion and sincere concern for others.', 'B) Prioritizing profits over customer satisfaction.', 'C) Following strict corporate rules without considering others.', 'D) A marketing strategy that uses emotional appeal.'],
            'answer' => 'A'
        ],
        [
            'question' => 'Accountability',
            'choices' => ['A) The ability to delegate tasks to others without consequences.', 'B) The responsibility of employees for their actions, decisions, and performance.', 'C) The practice of shifting blame to colleagues for mistakes.', 'D) A company policy that encourages secrecy in decision-making.'],
            'answer' => 'B'
        ],
        [
            'question' => 'Ethics and morals are the same.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'B'
        ],
        [
            'question' => 'Ethical business practices have no impact on consumer confidence.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'B'
        ],
        [
            'question' => 'A company’s reputation is not affected by its ethical decisions',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'B'
        ],
        [
            'question' => 'Employees should prioritize personal gain over the company’s best interest',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'B'
        ],
        [
            'question' => 'Honesty is a core principle of business ethics.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'A'
        ],
        [
            'question' => 'Overpricing a product always leads to higher profits.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'B'
        ],
        [
            'question' => 'Respect is essential for a healthy workplace.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'A'
        ],
        [
            'question' => 'Account manipulation is an ethical business practice.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'B'
        ],
        [
            'question' => 'A good leader in business is one who empowers others.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'A'
        ],
        [
            'question' => 'Ethical businesses benefit financially in the long run.',
            'choices' => ['A) True', 'B) False'],
            'answer' => 'A'
        ],
        [
            'question' => 'What is responsibility in the context of entrepreneurship?',
            'choices' => ['A) Responsibility is the ability to delegate all tasks to employees without oversight.', 'B) Responsibility is solely about maximizing profits without ethical considerations.', 'C) Responsibility is a person’s conscious decision and behavior that seeks to improve oneself and/or help others.', 'D) Responsibility is following legal requirements without concern for social impact.'],
             'answer' => 'C'
        ],
        [
            'question' => 'What is social responsibility?',
            'choices' => [
                'A) Social responsibility is the obligation to follow only government regulations without considering ethics.', 
                'B) Social responsibility is the responsibility towards society and the environment, including ethical decision-making in personal and corporate life.', 
                'C) Social responsibility is the practice of maximizing profits without concern for society.', 
                'D) Social responsibility is a company\'s strategy to increase its market share.'
            ],
            'answer' => 'B'
        ],
        [
            'question' => 'What is ethical decision-making?',
            'choices' => ['A) It involves making choices that align with moral values in personal and corporate life.', 'B) It is the process of making decisions based solely on financial gain.', 'C) It refers to following only the legal requirements without considering ethics.', 'D) It is a strategy used to manipulate customers into trusting a brand.'],
             'answer' => 'A'
        ],
        [
            'question' => 'What are the three types of social responsibility?',
            'choices' => ['A) 1) Financial responsibility, 2) Business expansion, 3) Legal compliance.', 'B) 1) Marketing responsibility, 2) Customer service, 3) Profit maximization.', 'C) 1) Political responsibility, 2) Economic stability, 3) Global trade.', 'D) 1) Personal responsibility, 2) Corporate social responsibility (CSR), 3) Environmental responsibility.'],
             'answer' => 'D'
        ],
        [
            'question' => 'What is corporate social responsibility (CSR)?',
            'choices' => ['A) A strategy solely focused on maximizing profits.', 'B) A government-mandated tax policy for businesses.', 'C) A company’s obligation to shareholders only.', 'D) Business practices that comply with laws and contribute positively to society.'],
             'answer' => 'D'
        ],
        [
            'question' => 'What are the 8 basic rights of customers?',
            'choices' => ['A) Right to basic needs, 2) Right to safety, 3) Right to information, 4) Right to choose, 5) Right to representation, 6) Right to redress, 7) Right to education, 8) Right to a healthy environment.', 'B) 1) Right to discounts, 2) Right to refunds, 3) Right to complain, 4) Right to convenience, 5) Right to free products, 6) Right to loyalty rewards, 7) Right to luxury, 8) Right to premium service.', 'C) 1) Right to negotiate prices, 2) Right to special treatment, 3) Right to free samples, 4) Right to unlimited warranties, 5) Right to replacement, 6) Right to customization, 7) Right to membership, 8) Right to express opinions.', 'D) 1) Right to demand, 2) Right to be prioritized, 3) Right to exclusive services, 4) Right to influence business decisions, 5) Right to free delivery, 6) Right to extra services, 7) Right to VIP treatment, 8) Right to refunds anytime.'],
             'answer' => 'A'
        ],
        [
            'question' => 'What is RA 7394?',
            'choices' => ['A) It is a law that regulates employee salaries.', 'B) It is a tax law for business owners.', 'C) It is the Consumer Act of the Philippines, which protects consumer rights.', 'D) It is a trade agreement between businesses and the government.'],
             'answer' => 'C'
        ],
        [
            'question' => 'What is the role of businesses in social responsibility towards consumers?',
            'choices' => ['A) Businesses should be honest, inform customers of terms and conditions, provide courteous treatment, and not exploit customers.', 'B) Businesses should maximize profits by any means necessary.', 'C) Businesses should prioritize their interests over consumer rights.', 'D) Businesses should avoid transparency in their dealings.'],
             'answer' => 'A'
        ],
        [
            'question' => 'What is the responsibility of businesses towards employees?',
            'choices' => ['A) Avoiding workplace benefits to cut costs.', 'B) Prioritizing customers over employees.', 'C) Keeping wages low to maximize profit.', 'D) Ensuring employee happiness, providing healthy working conditions, considering employee needs, encouraging appreciation, paying fair wages, and following labor laws.'],
             'answer' => 'D'
        ],
        [
            'question' => 'Why is fair employee compensation important?',
            'choices' => ['A) It is an optional practice that does not affect employee performance.', 'B) It is only necessary for businesses with large profits.', 'C) It allows businesses to pay employees any amount they choose.', 'D) It ensures workers receive the salary and benefits agreed upon, following the Labor Code.'],
             'answer' => 'D'
        ],
        [
            'question' => 'What is a supplier?',
            'choices' => ['A) A person or business that provides products or services to another entity.', 'B) A company that only sells products directly to customers.', 'C) A person who purchases goods in bulk for personal use.', 'D) A department within a company that handles employee relations.'],
             'answer' => 'A'
        ],
        [
            'question' => 'What are the responsibilities of companies towards suppliers?	',
            'choices' => ['A) 1) Delay payments as long as possible, 2) Demand lower prices unfairly, 3) Change suppliers frequently.', 'B) 1) Build lasting relationships, 2) Pay suppliers on time, 3) Pay fair prices for goods.', 'C) 1) Only work with suppliers when convenient, 2) Focus solely on cost-cutting, 3) Avoid communication with suppliers.', 'D) 1) Force suppliers to lower costs, 2) Prioritize profits over fair payments, 3) Ignore supplier concerns.'],
             'answer' => 'B'
        ],
        [
            'question' => 'What does environmental responsibility mean for companies?',
            'choices' => ['A) It means using as many natural resources as possible without concern.', 'B) It requires businesses to focus only on profit, regardless of environmental impact.', 'C) It involves sustainable practices and reducing carbon footprints.', 'D) It is a government-imposed tax on environmentally friendly companies.'],
             'answer' => 'C'
        ],
        [
            'question' => 'How does social responsibility benefit businesses?',
            'choices' => ['A) It increases operational costs without any benefits.', 'B) It improves brand reputation, customer loyalty, and long-term sustainability.', 'C) It makes companies focus solely on charity instead of profits.', 'D) It forces businesses to operate under strict government control.'],
             'answer' => 'B'
        ],
        [
            'question' => 'What is the main goal of corporate social responsibility?',
            'choices' => ['A) To balance profit-making with social and environmental good.', 'B) To eliminate competition in the market.', 'C) To increase profits without regard for ethics.', 'D) To avoid legal consequences by following minimal regulations.'],
             'answer' => 'A'
        ],
        [
            'question' => 'What are the primary stakeholders of a business?',
            'choices' => ['A) 1) Celebrities, 2) Competitors, 3) Social media influencers, 4) Political figures.', 'B) 1) Government agencies, 2) Advertising firms, 3) Banks, 4) Media companies.', 'C) 1) Customers, 2) Employees, 3) Suppliers, 4) Investors.', 'D) 1) Customers, 2) Employees, 3) Suppliers, 4) Investors.'],
             'answer' => 'D'
        ],
        [
            'question' => 'How does ethical decision-making apply to businesses?',
            'choices' => ['A) It allows businesses to prioritize profits over ethical concerns.', 'B) It ensures fairness in operations, wages, pricing, and treatment of employees and customers.', 'C) It focuses only on following legal requirements, not moral values.', 'D) It encourages companies to manipulate customers for financial gain.'],
             'answer' => 'B'
        ],
    ],

];

$selected_subject = $_POST['subject'] ?? $_SESSION['selected_subject'] ?? null;
$_SESSION['selected_subject'] = $selected_subject;
$questions = $selected_subject ? ($questions_by_subject[$selected_subject] ?? []) : [];
$total_questions = count($questions);
$score = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_quiz'])) {
    $score = isset($_POST['correct_answers']) ? intval($_POST['correct_answers']) : 0;
    
    // Save score to database
    $quizController->saveScore($_SESSION['user_id'], $score, $total_questions);
    $_SESSION['quiz_score'] = $score;
    $_SESSION['quiz_submitted'] = true;
    header("Refresh:0");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .flashcard-container {
            perspective: 1000px;
            width: 100%;
            height: 400px;
            margin-bottom: 20px;
        }

        .flashcard {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.6s ease-in-out;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .flashcard.flipped {
            transform: rotateY(180deg);
        }

        .flashcard-front, .flashcard-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            padding: 20px;
        }

        .flashcard-front {
            background: linear-gradient(to right, #4a6cf7, #3b5bdb);
            color: white;
        }

        .flashcard-back {
            background: white;
            transform: rotateY(180deg);
            color: #333;
        }

        .choices {
            width: 100%;
            margin-top: 15px;
        }

        .choice {
            width: 100%;
            margin: 5px 0;
            text-align: left;
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: background-color 0.3s;
        }

        .choice:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .answer-result {
            width: 100%;
            margin-bottom: 20px;
        }

        .next-card {
            width: 100%;
            margin-top: 20px;
        }
    </style>
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
        <h2 class="text-2xl font-bold text-gray-800">Flashcard Quiz</h2>
        <?php if (!isset($_SESSION['quiz_submitted']) || !$_SESSION['quiz_submitted']): ?>
        <form method="POST">
            <label class="block text-gray-700">Choose a subject:</label>
            <select name="subject" class="w-full p-2 border rounded-lg">
                <option value="">Select</option>
                <?php foreach ($subjects as $key => $value): ?>
                    <option value="<?= $key ?>" <?= $selected_subject === $key ? 'selected' : '' ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Start</button>
        </form>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['quiz_submitted']) && $_SESSION['quiz_submitted']): ?>
        <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">Quiz Results: <?= $subjects[$selected_subject] ?></h3>
            <div class="mt-4 p-4 bg-blue-100 rounded-lg">
                <p class="text-lg">Your score: <span class="font-bold"><?= $_SESSION['quiz_score'] ?> out of <?= $total_questions ?></span></p>
                <p class="text-md mt-2">Percentage: <span class="font-bold"><?= ($total_questions > 0) ? round(($_SESSION['quiz_score'] / $total_questions) * 100) : 0 ?>%</span></p>
            </div>
            <form method="POST" class="mt-4">
                <input type="hidden" name="subject" value="<?= $selected_subject ?>">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Take Quiz Again</button>
            </form>
            <?php 
                // Clear the submission flag to allow retaking the quiz
                $_SESSION['quiz_submitted'] = false;
            ?>
        </div>
    <?php elseif ($selected_subject && !empty($questions)): ?>
        <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
            <h3 class="text-xl font-semibold text-gray-800">Quiz: <?= $subjects[$selected_subject] ?></h3>
            <p class="text-gray-600 mb-4">Click on a choice to see if you're correct, then submit your score when done.</p>
            
            <div id="quiz-container">
                <?php foreach ($questions as $index => $q): ?>
                <div class="flashcard-container">
                    <div class="flashcard">
                        <div class="flashcard-front">
                            <p class="text-lg font-medium mb-4 text-center"><?= $q['question'] ?></p>
                            <div class="choices">
                                <?php foreach ($q['choices'] as $choice): ?>
                                <button class="choice px-3 py-2 rounded-lg mb-2 w-full hover:bg-blue-600"
                                        data-answer="<?= $choice ?>" 
                                        data-correct="<?= ($choice === $q['answer']) ? '1' : '0' ?>">
                                    <?= $choice ?>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="flashcard-back">
                            <div class="answer-result text-center w-full">
                                <div class="correct-answer hidden">
                                    <div class="bg-green-100 p-4 rounded-lg">
                                        <p class="text-green-700 text-lg font-bold">Correct!</p>
                                        <p class="mt-2">The answer is: <span class="font-bold"><?= $q['answer'] ?></span></p>
                                    </div>
                                </div>
                                <div class="wrong-answer hidden">
                                    <div class="bg-red-100 p-4 rounded-lg">
                                        <p class="text-red-700 text-lg font-bold">Incorrect</p>
                                        <p class="mt-2">The correct answer is: <span class="font-bold"><?= $q['answer'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <button class="next-card mt-4 bg-gray-500 text-white px-3 py-2 rounded-lg w-full hover:bg-gray-600">Next Card</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <form method="POST" id="submit-form" class="mt-8">
                <input type="hidden" name="correct_answers" id="correct-answers" value="0">
                <button type="submit" name="submit_quiz" id="submit-quiz" class="w-full bg-green-500 text-white px-4 py-3 rounded-lg text-lg font-bold hover:bg-green-600 disabled:bg-gray-400" disabled>
                    Submit Quiz
                </button>
            </form>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let correctAnswers = 0;
            let totalAnswered = 0;
            let currentCardIndex = 0;
            const cards = document.querySelectorAll('.flashcard-container');
            const totalQuestions = <?= count($questions ?? []) ?>;
            const submitButton = document.getElementById('submit-quiz');
            
            // Show only the first card initially
            if (cards.length > 0) {
                cards.forEach((card, index) => {
                    if (index !== 0) {
                        card.style.display = 'none';
                    }
                });
            }
            
            // Handle choice selection
            document.querySelectorAll('.choice').forEach(choice => {
                choice.addEventListener('click', function() {
                    const cardContainer = this.closest('.flashcard-container');
                    const card = cardContainer.querySelector('.flashcard');
                    const isCorrect = this.dataset.correct === '1';

                    // Flip the card to show the back side
                    card.classList.add('flipped');

                    // Show correct/wrong message
                    if (isCorrect) {
                        cardContainer.querySelector('.correct-answer').classList.remove('hidden');
                        correctAnswers++;
                    } else {
                        cardContainer.querySelector('.wrong-answer').classList.remove('hidden');
                    }

                    // Disable all choices in this card
                    cardContainer.querySelectorAll('.choice').forEach(btn => {
                        btn.disabled = true;
                        btn.classList.add('opacity-50');
                    });

                    // Update total answered
                    totalAnswered++;

                    // Update hidden field with correct answers
                    document.getElementById('correct-answers').value = correctAnswers;

                    // Enable submit button if all questions are answered
                    if (totalAnswered === totalQuestions) {
                        submitButton.disabled = false;
                    }
                });
            });
            
            // Handle next card button
            document.querySelectorAll('.next-card').forEach(button => {
                button.addEventListener('click', function() {
                    const currentCard = cards[currentCardIndex];
                    
                    // Hide current card
                    currentCard.style.display = 'none';
                    
                    // Show next card if exists
                    currentCardIndex++;
                    if (currentCardIndex < cards.length) {
                        cards[currentCardIndex].style.display = 'block';
                    } else {
                        // All cards have been viewed, show submit button
                        submitButton.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });
    </script>
</body>
</html>