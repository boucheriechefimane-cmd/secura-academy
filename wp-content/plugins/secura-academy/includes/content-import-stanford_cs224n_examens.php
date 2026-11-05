<?php
/**
 * Questions importees — Stanford CS224N Natural Language Processing — midterm Winter 2018 et partiels d'entraînement, avec les corrigés officiels
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : Aucune licence explicite publiee sur ces pages
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)
 */
if ( ! function_exists( 'seca_import_stanford_cs224n_examens' ) ) {
	function seca_import_stanford_cs224n_examens() {
		return array(
			'source' => array('id' => 'stanford-cs224n-examens', 'nom' => 'Stanford CS224N Natural Language Processing — midterm Winter 2018 et partiels d\'entraînement, avec les corrigés officiels', 'url' => 'https://web.stanford.edu/class/archive/cs/cs224n/cs224n.1184/midterm/', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'attribution' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — a] Which of the following statement about Skip-gram are correct?
It predicts the center word from the surrounding context words
The final word vector for a word is the average or sum of the input vector v and output vector u corresponding to that word
When it comes to a small corpus, it has better performance than GloVe
It makes use of global co-occurrence statistics', 'mode' => 'choice', 'choices' => array('It predicts the center word from the surrounding context words', 'The final word vector for a word is the average or sum of the input vector v and output vector u corresponding to that word', 'When it comes to a small corpus, it has better performance than GloVe', 'It makes use of global co-occurrence statistics'), 'correct' => 1, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The final word vector for a word is the average or sum of the input vector v and output vector u corresponding to that word', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — b] Which of the following statements about dependency trees are correct?
Each word is connected to exactly one dependent (i.e., each word has exactly one outgoing edge)
A dependency tree with crossing edges is called a “projective” dependency tree.
Assuming it parses the sentence correctly, the last transition made by the dependency parser from class and assignment 2 will always be a RIGHT-ARC connecting ROOT to some word.
None of the above', 'mode' => 'choice', 'choices' => array('Each word is connected to exactly one dependent (i.e., each word has exactly one outgoing edge)', 'A dependency tree with crossing edges is called a “projective” dependency tree.', 'Assuming it parses the sentence correctly, the last transition made by the dependency parser from class and assignment 2 will always be a RIGHT-ARC connecting ROOT to some word.', 'None of the above'), 'correct' => 2, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Assuming it parses the sentence correctly, the last transition made by the dependency parser from class and assignment 2 will always be a RIGHT-ARC connecting ROOT to some word.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — c] Which of the following statements is true of language models?
Neural window-based models share weights across the window
Neural window-based language models suffer from the sparsity problem, but n-gram language models do not
The number of parameters in an RNN language model grows with the number of time steps
Neural window-based models can be parallelized, but RNN lan-guage models cannot', 'mode' => 'choice', 'choices' => array('Neural window-based models share weights across the window', 'Neural window-based language models suffer from the sparsity problem, but n-gram language models do not', 'The number of parameters in an RNN language model grows with the number of time steps', 'Neural window-based models can be parallelized, but RNN lan-guage models cannot'), 'correct' => 3, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : D: Gradients must flow through each time step for RNNs whereas for neural window-based models can perform its forward- and back-propagation in parallel.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — d] Assume x and y get multiplied together element-wise x∗y. Sx and Sy are the shapes of x and y respectively. For which Sx and Sy will Numpy / Tensorflow throw an error?
Sx = [1 , 10] , S y = [10 , 10]
Sx = [10 , 1] , S y = [10 , 1]
Sx = [10 , 100] , S y = [100 , 10]
Sx = [1 , 10 , 100] , S y = [1 , 1, 1]', 'mode' => 'choice', 'choices' => array('Sx = [1 , 10] , S y = [10 , 10]', 'Sx = [10 , 1] , S y = [10 , 1]', 'Sx = [10 , 100] , S y = [100 , 10]', 'Sx = [1 , 10 , 100] , S y = [1 , 1, 1]'), 'correct' => 2, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Sx = [10 , 100] , S y = [100 , 10]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — e] Suppose that you are training a neural network for classification, but you notice that the training loss is much lower than the validation loss. Which of the following can be used to address the issue (select all that apply)? Page 2 √ Use a network with fewer layers
Decrease dropout probability
Increase L2 regularization weight
Increase the size of each hidden layer', 'mode' => 'choice', 'choices' => array('Decrease dropout probability', 'Increase L2 regularization weight', 'Increase the size of each hidden layer'), 'correct' => 1, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : A, C – the model is now overfitting, and all of these are valid tech-niques to address it. However, since dropout is a form of regularization, then decreasing it (B) will have the opposite effect, as will increasing network size (D).', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — f] Suppose a classifier predicts each possible class with equal probability. If there are 10 classes, what will the cross-entropy error be on a single example?
− log(10)
− 0.1 log(1)
− log(0 .1)
− 10 log(0 .1)', 'mode' => 'choice', 'choices' => array('− log(10)', '− 0.1 log(1)', '− log(0 .1)', '− 10 log(0 .1)'), 'correct' => 2, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : C. Cross-Entropy loss simplifies to negative log of the predicted prob-ability for the correct class. At the start of training, we have approximately uniform probabilities for the 10 classes, or 0.1 for each class. So, that means -log(0.1) is what the loss should approximately be at the start.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — h] During backpropagation, when the gradient flows backwards through the sigmoid or tanh non-linearities, it cannot change sign. √ True © False', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : A. True. The local gradient for both of these non-linearites is always positive.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — h] During backpropagation, when the gradient flows backwards through the sigmoid or tanh non-linearities, it cannot change sign. √ True © False]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — h] During backpropagation, when the gradient flows backwards through the sigmoid or tanh non-linearities, it cannot change sign. √ True © False', '_recupere_le' => '2026-11-04T19:55:22.829685+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : A. True. The local gradient for both of these non-linearites is always positive.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Suppose we are training a neural network with stochastic gradient de-scent on minibatches. True or false: summing the cost across the minibatch is equivalent to averaging the cost across the minibatch, if in the first case we divide the learning rate by the minibatch size.', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : A. True. There is only a constant factor difference between averaging and summing, and you can simply multiply the learning rate to get the same update. Page 3 2. Short Questions (32 points)

Please write answers to the following questions in a sentence or two. (a) Suppose we want to classify movie review text as (1) either positive or negative sentiment, and (2) either action, comedy or romance movie genre. To perform these two related classification tasks, we use a neural network that shares the first layer, but branches into two separate layers to compute the two classifications. The loss is a weighted sum of the two cross-entropy losses.

h = ReLU( W0x + b0)ˆy1 = softmax( W1h + b1)ˆy2 = softmax( W2h + b2)

J = αCE( y1, ˆy1) + βCE( y2, ˆy2)Here input x ∈ R10 is some vector encoding of the input text, label ˆ y1 ∈ R2 is a one-hot vector encoding the true sentiment, label ˆ y2 ∈ R3 is a one-hot vector encoding the true movie genre, h ∈ R10 is a hidden layer, W0 ∈ R10 ×10 , W1 ∈

R2×10 , W2 ∈ R3×10 are weight matrices, and α and β are scalars that balance the two losses.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('L\'inverse de √ true © false', '√ True © False', 'Pas √ true © false', 'Impossible à déterminer'), 'correct' => 1, 'answer' => '√ True © False', '_recupere_le' => '2026-11-04T19:55:22.829834+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] To compute backpropagation for this network, we can use the mul-tivariable chain rule. Assuming we already know:', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : δT

> 3

∆1 + δT

> 4

∆2(row convention), or ∆1δT

> 3

+ ∆2δT

> 4

(column con-vention) If you are using row convention(numerator-layout notation), the dimensions of parameters in the questions are δT

> 3

: 1x2, ∆1: 2x10, δT

> 4

: 1x3, ∆2: 3x10 If you are using column convention(denominator-layout notation), the di-mensions of parameters in the questions are δT

> 3

: 2x1, ∆1: 10x2, δT

> 4

: 3x1,

∆2: 10x3', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas ∂ˆy1

∂x = ∆1, ∂ˆy2

∂x = ∆2, ∂j ∂ˆy1

= δt

> 3

, ∂j ∂ˆy2

= δt

> 4

what is ∂j ∂x ?', 'L\'inverse de ∂ˆy1

∂x = ∆1, ∂ˆy2

∂x = ∆2, ∂j ∂ˆy1

= δt

> 3

, ∂j ∂ˆy2

= δt

> 4

what is ∂j ∂x ?', '∂ˆy1

∂x = ∆1, ∂ˆy2

∂x = ∆2, ∂J ∂ˆy1

= δT

> 3

, ∂J ∂ˆy2

= δT

> 4

What is ∂J ∂x ?'), 'correct' => 3, 'answer' => '∂ˆy1

∂x = ∆1, ∂ˆy2

∂x = ∆2, ∂J ∂ˆy1

= δT

> 3

, ∂J ∂ˆy2

= δT

> 4

What is ∂J ∂x ?', '_recupere_le' => '2026-11-04T19:55:22.829971+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] When we train this model, we find that it underfits the training data. Why might underfitting happen in this case? Provide at least one suggestion to reduce underfitting.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The model is too simple (just two layers, hidden layers’ dimen-sion is only 10, input feature dimension is only 10). Anything increasing the complexity of the model would be accepted, in-cluding:

• Increasing dimensions of the hidden layer Page 4 • Adding more layers

• Splitting the model into two (with more overall parameters) (b) Practical Deep Learning Training

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] When we train this model, we find that it underfits the training data. Why might underfitting happen in this case? Provide at least one suggestion to reduce underfitting.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] When we train this model, we find that it underfits the training data. Why might underfitting happen in this case? Provide at least one suggestion to reduce underfitting.', '_recupere_le' => '2026-11-04T19:55:22.830060+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The model is too simple (just two layers, hidden layers’ dimen-sion is only 10, input feature dimension is only 10). Anything increasing the complexity of the model woul')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] In assignment 1, we saw that we could use gradient check, which calculates numerical gradients using the central difference formula, as a way to validate the accuracy of our analytical gradients. Why don’t we use the numerical gradient to train neural networks in practice?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Since calculating the complete numerical gradient for a single update requires iterating through all dimensions of all the parameters and computing two forward passes for each iteration, this becomes too expensive to use for training in practice.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] In assignment 1, we saw that we could use gradient check, which calculates numerical gradients using the central difference formula, as a way to validate the accuracy of our analytical gradients. Why don’t we use the numerical gradient to train neural networks in practice?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] In assignment 1, we saw that we could use gradient check, which calculates numerical gradients using the central difference formula, as a way to validate the accuracy of our analytical gradients. Why don’t we use the numerical gradient to train neural networks in practice?', '_recupere_le' => '2026-11-04T19:55:22.830176+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Since calculating the complete numerical gradient for a single update requires iterating through all dimensions of all the parameters and computing two forward passes fo')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] In class, we learned how the ReLU activation function (ReLU( z) = max(0 , z ) could ”die” or become saturated/inactive when the input is nega-tive. A friend of yours suggests the use of another activation function f (z) = max(0 .2z, 2z) which he claims will remove the saturation problem. Would this address the problem? Why or why not?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Yes, – it addresses the saturation problem of ReLU and also is not a purely linear function. In fact, this is just an instance of the Leaky ReLU non-linearity, frequently used to train neural nets in practice. Page 5

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] In class, we learned how the ReLU activation function (ReLU( z) = max(0 , z ) could ”die” or become saturated/inactive when the input is nega-tive. A friend of yours suggests the use of another activation function f (z) = max(0 .2z, 2z) which he claims will remove the saturation problem. Would this address the problem? Why or why not?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] In class, we learned how the ReLU activation function (ReLU( z) = max(0 , z ) could ”die” or become saturated/inactive when the input is nega-tive. A friend of yours suggests the use of another activation function f (z) = max(0 .2z, 2z) which he claims will remove the saturation problem. Would this address the problem? Why or why not?', '_recupere_le' => '2026-11-04T19:55:22.830318+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Yes, – it addresses the saturation problem of ReLU and also is not a purely linear function. In fact, this is just an instance of the Leaky ReLU non-linearity, frequentl')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] The same friend also proposes another activation function g(z) = 1.5z. Would this be a good activation function? Why or why not?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : No, this is not a good idea – this is no longer a non-linear func-tion, so the neural network boils down to a simple linear predictor.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] The same friend also proposes another activation function g(z) = 1.5z. Would this be a good activation function? Why or why not?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] The same friend also proposes another activation function g(z) = 1.5z. Would this be a good activation function? Why or why not?', '_recupere_le' => '2026-11-04T19:55:22.830393+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : No, this is not a good idea – this is no longer a non-linear func-tion, so the neural network boils down to a simple linear predictor.

[Correction officielle MIT : [Sta')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iv] There are several tradeoffs when choosing the batch size for training. Name one advantage for having very large batch sizes during training. Also, name one advantage for having very small batch sizes during training.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Larger batch sizes give you updates that are closer to the overall gradient on the dataset; small batches give you less exact but more frequent updates.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iv] There are several tradeoffs when choosing the batch size for training. Name one advantage for having very large batch sizes during training. Also, name one advantage for having very small batch sizes during training.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iv] There are several tradeoffs when choosing the batch size for training. Name one advantage for having very large batch sizes during training. Also, name one advantage for having very small batch sizes during training.', '_recupere_le' => '2026-11-04T19:55:22.830487+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Larger batch sizes give you updates that are closer to the overall gradient on the dataset; small batches give you less exact but more frequent updates.

[Correction off')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — v] Suppose we are training a feed-forward neural network with several hidden layers (all with ReLU non-linearities) and a softmax output. A friend suggests that you should initialize all the weights (including biases) to zeros. Is this a good idea or not? Explain briefly in 1-2 sentences.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : No – all neurons will receive the same update if they all start off with the same initialization due to symmetry. In fact, because everything is zeros to start off with, then there will be no gradient flow to any of the lower layers of the network (since the upstream gradients get multiplied by

Wi’s and hi’s, which are all 0). (Full credit was also given to students who mentioned saturation/dead ReLUs, or thinking about non-differentiability at 0 for ReLU.)

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — v] Suppose we are training a feed-forward neural network with several hidden layers (all with ReLU non-linearities) and a softmax output. A friend suggests that you should initialize all the weights (including biases) to zeros. Is this a good idea or not? Explain briefly in 1-2 sentences.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — v] Suppose we are training a feed-forward neural network with several hidden layers (all with ReLU non-linearities) and a softmax output. A friend suggests that you should initialize all the weights (including biases) to zeros. Is this a good idea or not? Explain briefly in 1-2 sentences.', '_recupere_le' => '2026-11-04T19:55:22.830607+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : No – all neurons will receive the same update if they all start off with the same initialization due to symmetry. In fact, because everything is zeros to start off with,')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — c] Word2Vec represents a family of embedding algorithms that are com-monly used in a variety of contexts. Suppose in a recommender system for online shopping, we have information about co-purchase records for items x1, x 2, . . . , x n', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : We can treat items that are copurchased with x to be in the ’con-text’ of item x (1 point). We can use those copurchase records to build item embeddings akin to Word2Vec. (2 points, you need to mention that item em-beddings are created). Then we can use a similarity metric such as finding the items with the largest cosine similarity to the average basket to determine item recommendations for users (1 point). Page 6 (d) In lectures and Assignment 2 you learned about transition-based dependency pars-ing. Another model for parsing sentences is a graph-based dependency parser. It takes as input a sentence [ w1, w 2, ..., w T ]. First, it encodes the sentence as a sequence of d-dimensional vectors [ h1, h2, ..., hT ] (usually using a bidirectional LSTM, but the particular details don’t matter for this question). Next, it assigns a score s(i, j ) to each possible dependency i → j going from word wi to word wj (in this question, the model only predicts which edges are in the dependency graph, not the types of the edges). The score is computed as s(i, j ) = hTi Ah j where A is a d × d weight matrix. There is also a score for having an edge going from ROOT to a word wj given as

s(ROOT , j ) = wT hj where w is a d-dimensional vector of weights. Lastly, the model assigns each word j the head whose edge scores the highest: argmax i∈[1 ,...,T ] s(i, j ).', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'L\'inverse de (for example, item xi is commonly bought together with item xj ). explain how you would use ideas similar to word2vec to recommend similar items to users who have shown interest in any one of the items.', '(for example, item xi is commonly bought together with item xj ). Explain how you would use ideas similar to Word2Vec to recommend similar items to users who have shown interest in any one of the items.', 'Pas (for example, item xi is commonly bought together with item xj ). explain how you would use ideas similar to word2vec to recommend similar items to users who have shown interest in any one of the items.'), 'correct' => 2, 'answer' => '(for example, item xi is commonly bought together with item xj ). Explain how you would use ideas similar to Word2Vec to recommend similar items to users who have shown interest in any one of the items.', '_recupere_le' => '2026-11-04T19:55:22.830816+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Is there a kind of parse tree this model can produce, but a transition-based dependency parser can’t? If so, what is this kind of tree?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Unlike a transition-based parser, this model can parse sentences with non-projective dependency trees (i.e., with crossing edges).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Is there a kind of parse tree this model can produce, but a transition-based dependency parser can’t? If so, what is this kind of tree?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Is there a kind of parse tree this model can produce, but a transition-based dependency parser can’t? If so, what is this kind of tree?', '_recupere_le' => '2026-11-04T19:55:22.830897+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Unlike a transition-based parser, this model can parse sentences with non-projective dependency trees (i.e., with crossing edges).

[Correction officielle MIT : [Stanfor')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Suppose the model instead scored each edge with a simple dot prod-uct: s(i, j ) = hTi hj . Why would this not work as well?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Any of the following is correct

• The score of an edge i → j will be the same as the score of an edge

j → i, which doesn’t make sense.

• s(i, i ) will be high, so words may get linked to themselves.

• Similar words will score highly, but often similar words should not be connected in a dependency tree.

• A allows the model to express more complex interactions between the elements of the h vectors.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Suppose the model instead scored each edge with a simple dot prod-uct: s(i, j ) = hTi hj . Why would this not work as well?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Suppose the model instead scored each edge with a simple dot prod-uct: s(i, j ) = hTi hj . Why would this not work as well?', '_recupere_le' => '2026-11-04T19:55:22.830976+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Any of the following is correct

• The score of an edge i → j will be the same as the score of an edge

j → i, which doesn’t make sense.

• s(i, i ) will be high, so wor')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] What is one disadvantange of graph-based dependency parsers com-pared to transition-based dependency parsers?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Any of the following is correct:

• Graph-based dependency parsers are slower (quadratic time instead of linear in the length of the sentence).

• Graph-based dependency parsers are not constrained to produce valid parse trees, so they may be more likely to produce invalid ones.

• Graph-based dependency parsers make parsing decisions independently so they can’t use features based on previous parsing decisions. Page 7 3. Word Vectors (12 points)

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] What is one disadvantange of graph-based dependency parsers com-pared to transition-based dependency parsers?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] What is one disadvantange of graph-based dependency parsers com-pared to transition-based dependency parsers?', '_recupere_le' => '2026-11-04T19:55:22.831040+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Any of the following is correct:

• Graph-based dependency parsers are slower (quadratic time instead of linear in the length of the sentence).

• Graph-based dependency')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — a] Although pre-trained word vectors work very well in many practical downstream tasks, in some settings it’s best to continue to learn (i.e. ‘retrain’) the word vectors as parameters of our neural network. Explain why retraining the word vectors may hurt our model if our dataset for the specific task is too small.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : See TV/television/telly example from lecture 4. Word vectors in training data move around; word vectors not in training data don’t move around. Destroys structure of word vector space. Could also phrase as an overfitting or generalization problem.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — a] Although pre-trained word vectors work very well in many practical downstream tasks, in some settings it’s best to continue to learn (i.e. ‘retrain’) the word vectors as parameters of our neural network. Explain why retraining the word vectors may hurt our model if our dataset for the specific task is too small.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — a] Although pre-trained word vectors work very well in many practical downstream tasks, in some settings it’s best to continue to learn (i.e. ‘retrain’) the word vectors as parameters of our neural network. Explain why retraining the word vectors may hurt our model if our dataset for the specific task is too small.', '_recupere_le' => '2026-11-04T19:55:22.831167+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : See TV/television/telly example from lecture 4. Word vectors in training data move around; word vectors not in training data don’t move around. Destroys structure of wor')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — b] Give 2 examples of how we can evaluate word vectors. For each example, please indicate whether it is intrinsic or extrinsic.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Intrinsic: Word Vector Analogies ; Word vector distances and their correlation with human judgments. Extrinsic: Name entity recognitions: finding a person, location or organization and so on.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — b] Give 2 examples of how we can evaluate word vectors. For each example, please indicate whether it is intrinsic or extrinsic.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — b] Give 2 examples of how we can evaluate word vectors. For each example, please indicate whether it is intrinsic or extrinsic.', '_recupere_le' => '2026-11-04T19:55:22.831238+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Intrinsic: Word Vector Analogies ; Word vector distances and their correlation with human judgments. Extrinsic: Name entity recognitions: finding a person, location or o')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — c] In lectures, we saw how word vectors can alternatively be learned via co-occurrence count-based methods. How does Word2Vec compare with these meth-ods? Please briefly explain one advantage and one disadvantage of the Word2Vec model.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Advantage of word2vec: scale with corpus size; capture complex patterns beyond word similarity Disadvantage: slower than occurrence count based model; efficient usage of statistics

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — c] In lectures, we saw how word vectors can alternatively be learned via co-occurrence count-based methods. How does Word2Vec compare with these meth-ods? Please briefly explain one advantage and one disadvantage of the Word2Vec model.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — c] In lectures, we saw how word vectors can alternatively be learned via co-occurrence count-based methods. How does Word2Vec compare with these meth-ods? Please briefly explain one advantage and one disadvantage of the Word2Vec model.', '_recupere_le' => '2026-11-04T19:55:22.831338+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Advantage of word2vec: scale with corpus size; capture complex patterns beyond word similarity Disadvantage: slower than occurrence count based model; efficient usage of')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — d] Alice and Bob have each used the Word2Vec algorithm to obtain word embeddings for the same vocabulary of words V . In particular, Alice has obtained ‘context’ vectors uAw and ‘center’ vectors vAw for every w ∈ V , and Bob has obtained ‘context’ vectors uBw and ‘center’ vectors vBw for every w ∈ V .Suppose that, for every pair of words w, w ′ ∈ V , the inner product is the same in both Alice and Bob’s model: ( uAw)T vAw′ = ( uBw )T vBw′ . Does it follow that, for every word w ∈ V , vAw = vBw ? Why or why not?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : No. Word2Vec model only optimizes for the inner product between word vectors for words in the same context. One can rotate all word vectors by the same amount and the inner product will still be the same. Alternatively one can scale the set of context vectors by a Page 8 factor of k and the set of center vectors by a factor of 1 /k . Such transformations preserves inner product, but the set of vectors could be different. Note that degenerate solutions (all zero vectors etc.) are discouraged. Page 9 4. Backpropagation (17 points)

In class, we used the sigmoid function as our activation function . The most widely used activation function in deep learning now is ReLU : Rectified Linear Unit: ReLU( z) = max(0 , z )In this problem, we’ll explore using the ReLU function in a neural network. Through-out this problem, you are allowed (and highly encouraged) to use variables to represent intermediate gradients (i.e. δ1, δ2, etc.).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — d] Alice and Bob have each used the Word2Vec algorithm to obtain word embeddings for the same vocabulary of words V . In particular, Alice has obtained ‘context’ vectors uAw and ‘center’ vectors vAw for every w ∈ V , and Bob has obtained ‘context’ vectors uBw and ‘center’ vectors vBw for every w ∈ V .Suppose that, for every pair of words w, w ′ ∈ V , the inner product is the same in both Alice and Bob’s model: ( uAw)T vAw′ = ( uBw )T vBw′ . Does it follow that, for every word w ∈ V , vAw = vBw ? Why or why not?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — d] Alice and Bob have each used the Word2Vec algorithm to obtain word embeddings for the same vocabulary of words V . In particular, Alice has obtained ‘context’ vectors uAw and ‘center’ vectors vAw for every w ∈ V , and Bob has obtained ‘context’ vectors uBw and ‘center’ vectors vBw for every w ∈ V .Suppose that, for every pair of words w, w ′ ∈ V , the inner product is the same in both Alice and Bob’s model: ( uAw)T vAw′ = ( uBw )T vBw′ . Does it follow that, for every word w ∈ V , vAw = vBw ? Why or why not?', '_recupere_le' => '2026-11-04T19:55:22.831543+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : No. Word2Vec model only optimizes for the inner product between word vectors for words in the same context. One can rotate all word vectors by the same amount and the in')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — a] Compute the gradient of the ReLU function, i.e. derive ∂∂z ReLU.', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : ∂∂z ReLU = 1 {z > 0} (1) (b) Now, we’ll use the ReLU function to construct a multi-layer neural network. Below, the figure on the left shows a computation graph for a single ReLU hidden layer at layer i. The second figure shows the computation graph for the full neural network we’ll use in this problem. The network is specified by the equations below: Page 10 ReLU layer i

Neural network with 2 ReLU layers

z1 = W1x + b1

h1 = ReLU( z1)

z2 = W2h1 + b2

h2 = ReLU( z2)ˆy = softmax( h2)

J = CE( y, ˆy)CE( y, ˆy) = − ∑

> i

yi log(ˆ yi)The dimensions of our parameters and variables are x ∈ RDx×1, W1 ∈ RH×Dx ,

b1 ∈ RH , W2 ∈ RDy ×H , b2 ∈ RDy , ˆ y ∈ RDy ×1. Note: x is a single column vector.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas hint: you can use the following notation:

1{x > 0} =

{

1 if x > 0,

0 if x ≤ 0', 'Hint: You can use the following notation:

1{x > 0} =

{

1 if x > 0,

0 if x ≤ 0', 'L\'inverse de hint: you can use the following notation:

1{x > 0} =

{

1 if x > 0,

0 if x ≤ 0'), 'correct' => 2, 'answer' => 'Hint: You can use the following notation:

1{x > 0} =

{

1 if x > 0,

0 if x ≤ 0', '_recupere_le' => '2026-11-04T19:55:22.831735+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Compute the gradients ∂J ∂W2 and ∂J ∂b2 .', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : δ1 = ∂J ∂h 2

= ˆ y − yδ2 = ∂J ∂z 2

= δ1

∂h 2

∂z 2

= δ1 ◦ 1{z2 > 0}

∂J ∂b 2

= δ2

∂J ∂W 2

= δ2hT

> 1', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas hint: recall from pa1 that ∂j ∂θ = ˆ y − y, where θ is the inputs of softmax.', 'L\'inverse de hint: recall from pa1 that ∂j ∂θ = ˆ y − y, where θ is the inputs of softmax.', 'Hint: Recall from PA1 that ∂J ∂θ = ˆ y − y, where θ is the inputs of softmax.', 'Impossible à déterminer'), 'correct' => 2, 'answer' => 'Hint: Recall from PA1 that ∂J ∂θ = ˆ y − y, where θ is the inputs of softmax.', '_recupere_le' => '2026-11-04T19:55:22.831832+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Compute the gradients ∂J ∂W1 and ∂J ∂b1 . You may use gradients you have already derived in the previous part. Page 11', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : δ3 = ∂J ∂h 1

= δ2

∂z 2

∂h 1

= W T

> 2

δ2

δ4 = ∂J ∂z 1

= δ3

∂h 1

∂z 1

= δ3 ◦ 1{z1 > 0}

∂J ∂b 1

= δ4

∂J ∂W 1

= δ4xT

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Compute the gradients ∂J ∂W1 and ∂J ∂b1 . You may use gradients you have already derived in the previous part. Page 11]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Compute the gradients ∂J ∂W1 and ∂J ∂b1 . You may use gradients you have already derived in the previous part. Page 11', '_recupere_le' => '2026-11-04T19:55:22.831907+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : δ3 = ∂J ∂h 1

= δ2

∂z 2

∂h 1

= W T

> 2

δ2

δ4 = ∂J ∂z 1

= δ3

∂h 1

∂z 1

= δ3 ◦ 1{z1 > 0}

∂J ∂b 1

= δ4

∂J ∂W 1

= δ4xT

[Correction officielle MIT : [Stanford')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — c] When neural networks become very deep (i.e. have many layers), they become difficult to train due to the vanishing gradient problem – as the gradient is back-propagated through many layers, repeated multiplication can make the gradi-ent extremely small, so that performance plateaus or even degrades. An effective approach, particularly in computer vision applications, is ResNet. The core idea of ResNet is skip connections that skip one or more layers. See the computation graph below:

Neural network with skip connections

z1 = W1x + b1

h1 = ReLU( z1)

d = h1 + xz2 = W2d + b2

h2 = ReLU( z2)

θ = h2 + d

ˆy = softmax( θ)

J = CE( y, ˆy)For this part, the dimensions from part B still apply, but assume Dy = Dx = H.

Compute the gradient ∂J ∂x . Again, you are allowed (and highly encouraged) to use variables to represent intermediate gradients (i.e. δ1, δ2, etc.) Page 12 Hint: Use the computational graph to compute the upstream and local gradients for each node. Recall that downstream = upstream * local. Alternatively, compute each of these gradients in order to build up your', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : δ1 = ∂J ∂θ = ˆ y − yδ2 = ∂J ∂z 2

= ∂J ∂θ ∂θ ∂h 2

∂h 2

∂z 2

= δ1 ◦ 1{z2 > 0}

δ3 = ∂J ∂d = ∂J ∂z 2

∂z 2

∂d + ∂J ∂θ ∂θ ∂d = W T

> 2

δ2 + δ1

∂J ∂x = ∂J ∂d ∂d ∂h 1

∂h 1

∂x + ∂J ∂d ∂d ∂x = W T

> 1

(δ3 ◦ 1{z1 > 0}) + δ3

Page 13 5. RNNs (21 points)

RNNs are versatile! In class, we learned that this family of neural networks have many important advantages and can be used in a variety of tasks. They are commonly used in many state-of-the-art architectures for NLP. (a) For each of the following tasks, state how you would run an RNN to do that task. In particular, specify how the RNN would be used at test time (not training time), and specify 1. how many outputs i.e. number of times the softmax ˆy(t) is called from your RNN. If the number of outputs is not fixed, state it as arbitrary .2. what each ˆy(t) is a probability distribution over (e.g. distributed over all species of cats) 3. which inputs are fed at each time step to produce each output The inputs are specified below.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Impossible à déterminer', 'Pas ∂j ∂θ , ∂j ∂h2 , ∂j ∂z2 , ∂j ∂d , ∂j ∂x . show your work so we are able to give partial credit! please write your answer in the box provided on the next page.', '∂J ∂θ , ∂J ∂h2 , ∂J ∂z2 , ∂J ∂d , ∂J ∂x . Show your work so we are able to give partial credit! Please write your answer in the box provided on the next page.', 'L\'inverse de ∂j ∂θ , ∂j ∂h2 , ∂j ∂z2 , ∂j ∂d , ∂j ∂x . show your work so we are able to give partial credit! please write your answer in the box provided on the next page.'), 'correct' => 2, 'answer' => '∂J ∂θ , ∂J ∂h2 , ∂J ∂z2 , ∂J ∂d , ∂J ∂x . Show your work so we are able to give partial credit! Please write your answer in the box provided on the next page.', '_recupere_le' => '2026-11-04T19:55:22.832362+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Named-Entity Recognition: For each word in a sentence, classify that word as either a person, organization, location, or none. Inputs: A sentence containing n words.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Number of Outputs: n outputs, one per input word at each time step. Each ˆy(t) is a probability distribution over 4 NER categories. Each word in the sentence is fed into the RNN and one output is produced at every time step corresponding to the predicted tag/category for each word.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Named-Entity Recognition: For each word in a sentence, classify that word as either a person, organization, location, or none. Inputs: A sentence containing n words.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] Named-Entity Recognition: For each word in a sentence, classify that word as either a person, organization, location, or none. Inputs: A sentence containing n words.', '_recupere_le' => '2026-11-04T19:55:22.832446+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Number of Outputs: n outputs, one per input word at each time step. Each ˆy(t) is a probability distribution over 4 NER categories. Each word in the sentence is fed into')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Sentiment Analysis: Classify the sentiment of a sentence ranging from negative to positive (integer values from 0 to 4). Inputs: A sentence containing n words.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Number of Outputs: 1 output. n outputs is also acceptable if they say for instance to take average of all outputs. Each ˆy(t) is a probability distribution over 5 sentiment values. Each word in the sentence is fed into the RNN and one output is produced from the hidden states (by either taking only the final, max, or mean across all states) corresponding to the sentiment value of the sentence. Page 14

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Sentiment Analysis: Classify the sentiment of a sentence ranging from negative to positive (integer values from 0 to 4). Inputs: A sentence containing n words.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] Sentiment Analysis: Classify the sentiment of a sentence ranging from negative to positive (integer values from 0 to 4). Inputs: A sentence containing n words.', '_recupere_le' => '2026-11-04T19:55:22.832527+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Number of Outputs: 1 output. n outputs is also acceptable if they say for instance to take average of all outputs. Each ˆy(t) is a probability distribution over 5 sentim')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] Language models: generating text from a chatbot that was trained to speak like you by predicting the next word in the sequence. Input: A single start word or token that is fed into the first time step of the RNN.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Number of Outputs: arbitrary Each ˆy(t) is a probability distribution over the vocabulary. The previous output is fed as input for the next time step and produces the next output corresponding to the next predicted word of the generated sentence.

As a detail, the first input can also be a designated < ST ART > token and the first output would be the first word of the sentence.

(b) You build a sentiment analysis system that feeds a sentence into a RNN, and then computes the sentiment class between 0 (very negative) and 4 (very positive), based only on the final hidden state of the RNN.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] Language models: generating text from a chatbot that was trained to speak like you by predicting the next word in the sequence. Input: A single start word or token that is fed into the first time step of the RNN.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] Language models: generating text from a chatbot that was trained to speak like you by predicting the next word in the sequence. Input: A single start word or token that is fed into the first time step of the RNN.', '_recupere_le' => '2026-11-04T19:55:22.832645+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Number of Outputs: arbitrary Each ˆy(t) is a probability distribution over the vocabulary. The previous output is fed as input for the next time step and produces the ne')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] What is one advantage that an RNN would have over a neural window-based model for this task?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : There are multiple answers: We can process arbitrary length inputs. It can encode temporal information.(’Take ordering into considera-tion’ is only partial correct, because theoretically window-based model also can, although hard to). Shared weights. Less parameters. The number of parameters would increase proportional to the input size of the neu-ral window-based network whereas it would stay constant for RNNs since weights are shared at every time-step.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] What is one advantage that an RNN would have over a neural window-based model for this task?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — i] What is one advantage that an RNN would have over a neural window-based model for this task?', '_recupere_le' => '2026-11-04T19:55:22.832709+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : There are multiple answers: We can process arbitrary length inputs. It can encode temporal information.(’Take ordering into considera-tion’ is only partial correct, beca')),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — ii] You observe that your model predicts very positive sentiment for the following passage:', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The final word in the sentence is ’happy’ which has very positive sentiment. Since we only use the final hidden state to compute the output, the final word would have too much impact in the classification. In addition, because the sentence is quite long, information from earlier time steps may not survive due to the vanishing gradient problem. Page 15', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas yesterday turned out to be a terrible day. i overslept my alarm clock, and to make matters worse, my dog ate my homework. at least my dog seems happy...

why might the model misclassify the appropriate sentiment for this sentence?', 'Yesterday turned out to be a terrible day. I overslept my alarm clock, and to make matters worse, my dog ate my homework. At least my dog seems happy...

Why might the model misclassify the appropriate sentiment for this sentence?', 'L\'inverse de yesterday turned out to be a terrible day. i overslept my alarm clock, and to make matters worse, my dog ate my homework. at least my dog seems happy...

why might the model misclassify the appropriate sentiment for this sentence?', 'Impossible à déterminer'), 'correct' => 1, 'answer' => 'Yesterday turned out to be a terrible day. I overslept my alarm clock, and to make matters worse, my dog ate my homework. At least my dog seems happy...

Why might the model misclassify the appropriate sentiment for this sentence?', '_recupere_le' => '2026-11-04T19:55:22.832852+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iii] Your friend suggests using an LSTM instead. Recall the units of an LSTM cell are defined as

it = σ(W (i)xt + U (i)ht−1)

ft = σ(W (f )xt + U (f )ht−1)

ot = σ(W (o)xt + U (o)ht−1)

˜ct = tanh( W (c)xt + U (c)ht−1)

ct = ft ◦ ct−1 + it ◦ ˜ct

ht = ot ◦ tanh( ct)where the final output of the last lstm cell is defined by ˆ yt = softmax( htW + b). The final cost function J uses the cross-entropy loss. Consider an LSTM for two time steps, t and t − 1.

x(t−1)

U (c) (h(t−1)

> c(t−1)

)

x(t)

U (c) (h(t)

> c(t)

)

y(t)

...

Derive the gradient ∂J ∂U (c) in terms of the following gradients: ∂h t

> ∂h t−1

, ∂h t−1

> ∂U (c)

, ∂J ∂h t ,

> ∂c t
> ∂U (c)

, ∂c t−1

> ∂U (c)

, ∂c t

> ∂c t−1

, ∂h t

> ∂c t

, and ∂h t

> ∂o t

. Not all of the gradients may be used . You can leave the', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : ∂J ∂U (c) =

> t

∑

> i=t−1

∂J ∂U (c)

∣∣∣∣i

∂J ∂U (c) = ∂J ∂h t

(∂h t

∂c t

( ∂c t

∂U (c) + ∂c t

∂c t−1

∂c t−1

∂U (c) ) + ∂h t

∂h t−1

∂h t−1

∂U (c)

)

Because ∂c t

> ∂U (c)

is ambiguous, the following solution is also accepted:

∂J ∂U (c) =

> t

∑

> i=t−1

∂J ∂U (c)

∣∣∣∣i

∂J ∂U (c) = ∂J ∂h t

(∂h t

∂c t

∂c t

∂U (c) + ∂h t

∂h t−1

∂h t−1

∂U (c)

)

We must consider the gradient going through the current hidden state ht

to the memory cells, ct, ct−1, and to the previous hidden state ht−1

Page 16', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas in the form of chain rule and do not have to calculate any individual gradients in your final result.', 'L\'inverse de in the form of chain rule and do not have to calculate any individual gradients in your final result.', 'in the form of chain rule and do not have to calculate any individual gradients in your final result.', 'Impossible à déterminer'), 'correct' => 2, 'answer' => 'in the form of chain rule and do not have to calculate any individual gradients in your final result.', '_recupere_le' => '2026-11-04T19:55:22.833258+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — iv] Which part of the gradient ∂J ∂U (c) allows LSTMs to mitigate the effect of the vanishing gradient problem? Explain in two sentences or less how this would help classify the', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : ∂c t

> ∂c t−1

. Since ∂c t

> ∂c t−1

= ft, the forget gate, which can act as the identify function when ft = 1, this allows the gradients entering the current cell to pass to the previous cell. This would help the model take into consideration words that appear many time steps away. From the sentences in part b), it would take more into account the negative sentiment at the beginning.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('sentiment for the sentence in part b).', 'Impossible à déterminer', 'Pas sentiment for the sentence in part b).', 'L\'inverse de sentiment for the sentence in part b).'), 'correct' => 0, 'answer' => 'sentiment for the sentence in part b).', '_recupere_le' => '2026-11-04T19:55:22.833371+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [CS224N midterm 2018 — v] Rather than using the last hidden state to output the sentiment of a sentence, what could be a better', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : We can take advantage of every cell by taking a max pool/av-erage/sum of all hidden states. Page 17', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('L\'inverse de to improve the performance of the sentiment analysis task?', 'Impossible à déterminer', 'to improve the performance of the sentiment analysis task?', 'Pas to improve the performance of the sentiment analysis task?'), 'correct' => 2, 'answer' => 'to improve the performance of the sentiment analysis task?', '_recupere_le' => '2026-11-04T19:55:22.833464+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] If your training loss increases with number of epochs, which of the fol-lowing could be a possible issue with the learning process?
A. Regularization is too low and model is overfitting
B. Regularization is too high and model is underfitting
C. Step size is too large
D. Step size is too small', 'mode' => 'choice', 'choices' => array('A. Regularization is too low and model is overfitting', 'B. Regularization is too high and model is underfitting', 'C. Step size is too large', 'D. Step size is too small'), 'correct' => 2, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : C. The train loss always decreases whether the model is overfitting or underfitting. If the step size is too small, the convergence is too slow, but the training loss will still go down. If the step size is too large, it may cause a bouncing effect because we skip and overshoot the optimal solution. This leads to increase in training loss and decrease in training accuracy.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — b] In which of the following cases will there be no update when doing SGD with a max margin loss, J = max(0 , 1 − s + sc) where s is the true window score and sc is the corrupt window score?
A. ( s, s c) = (1 , 0.5)
B. ( s, s c) = (2 , 0.5)
C. ( s, s c) = (1 , 1.5)
D. ( s, s c) = (2 , 1.5)', 'mode' => 'choice', 'choices' => array('A. ( s, s c) = (1 , 0.5)', 'B. ( s, s c) = (2 , 0.5)', 'C. ( s, s c) = (1 , 1.5)', 'D. ( s, s c) = (2 , 1.5)'), 'correct' => 1, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : B. The max margin loss is 0 when s − sc > 1, which is only true for option B.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] The biggest advantage of neural transition-based dependency parsers over non-neural transition-based dependency parsers is that neural parsers:
A. Choose transitions using more words in the stack and buffer
B. Generate a larger class of dependency parses
C. Model a grammar whereas traditional parsers do not
D. Rely on dense feature representations', 'mode' => 'choice', 'choices' => array('A. Choose transitions using more words in the stack and buffer', 'B. Generate a larger class of dependency parses', 'C. Model a grammar whereas traditional parsers do not', 'D. Rely on dense feature representations'), 'correct' => 3, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : D. The main advantage of neural dependency parsers is that they offer a dense representation instead of a spare representation of the parser. Neural and traditional parsers are not different in what input information they can use, or what kinds of parses they can output (both can output any parse), but they differ in their representation of the features they use.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — d] Which one of the following is a valid projective dependency parse? Page 2 Which of the following is a valid projective dependency tree (a) C has no head (b) A has multiple heads (c)', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : C. In (A) Z has no head, in (B) W has two heads, and (D) is not projective because ROOT →X and Y →W cross.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas (d) not projective (root->b crosses c->a)

> root wxyz
> root wxyz
> root wxyz
> root wxyz
> (a)
> (b)
> (c)
> (d)', 'L\'inverse de (d) not projective (root->b crosses c->a)

> root wxyz
> root wxyz
> root wxyz
> root wxyz
> (a)
> (b)
> (c)
> (d)', 'Impossible à déterminer', '(d) Not projective (Root->B crosses C->A)

> ROOT WXYZ
> ROOT WXYZ
> ROOT WXYZ
> ROOT WXYZ
> (A)
> (B)
> (C)
> (D)'), 'correct' => 3, 'answer' => '(d) Not projective (Root->B crosses C->A)

> ROOT WXYZ
> ROOT WXYZ
> ROOT WXYZ
> ROOT WXYZ
> (A)
> (B)
> (C)
> (D)', '_recupere_le' => '2026-11-04T19:55:22.833629+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — e] We have learned that dense word vectors learned through word2vec or GloVe have many advantages over using sparse one-hot word vectors. Which of the following is NOT an advantage dense vectors have over sparse vectors?
A. Models using dense word vectors generalize better to unseen words than those using sparse vectors.
B. Models using dense word vectors generalize better to rare words than those using sparse vectors.
C. Dense word vectors encode similarity between words while sparse vectors do not.
D. Dense word vectors are easier to include as features in machine learning systems than sparse vectors.', 'mode' => 'choice', 'choices' => array('A. Models using dense word vectors generalize better to unseen words than those using sparse vectors.', 'B. Models using dense word vectors generalize better to rare words than those using sparse vectors.', 'C. Dense word vectors encode similarity between words while sparse vectors do not.', 'D. Dense word vectors are easier to include as features in machine learning systems than sparse vectors.'), 'correct' => 0, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : A. Just like sparse representations, word2vec or GloVe do not have representations for unseen words and hence do not help in generalization.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — f] Which of the following statements is INCORRECT?
A. Recurrent neural networks can handle a sequence of arbitrary length, while feedforward neural networks can not.
B. Training recurrent neural networks is hard because of vanishing and ex-ploding gradient problems.
C. Gradient clipping is an effective way of solving vanishing gradient prob-lem.
D. Gated recurrent units (GRUs) have fewer parameters than LSTMs.', 'mode' => 'choice', 'choices' => array('A. Recurrent neural networks can handle a sequence of arbitrary length, while feedforward neural networks can not.', 'B. Training recurrent neural networks is hard because of vanishing and ex-ploding gradient problems.', 'C. Gradient clipping is an effective way of solving vanishing gradient prob-lem.', 'D. Gated recurrent units (GRUs) have fewer parameters than LSTMs.'), 'correct' => 2, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : C. Gradient clipping is only a solution for solving exploding gradient problems, not vanishing gradient ones.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — g] In order for the following Tensorflow code to run, which of the following MUST be contained as keys of feed dict ?Page 3 import tensorflow as tf W = tf.Variable(tf.random_normal((200, 20))) b = tf.Variable(tf.zeros((20,))) x = tf.placeholder(tf.float32, (32, 200)) y = tf.matmul(x, W) + bprediction = tf.nn.softmax(y) label = tf.placeholder(tf.float32, (32, 20)) cross_entropy = tf.reduce_mean(-tf.reduce_sum(label * tf.log( prediction), reduction_indices =[1])) train_op = tf.train.GradientDescentOptimizer(0.5).minimize( cross_entropy) sess = tf.Session() sess.run(tf.initialize_all_variables()) feed_dict = _________________________ sess.run([prediction], feed_dict =feed_dict)
A. x, W, b
B. only x
C. only prediction
D. x and label', 'mode' => 'choice', 'choices' => array('A. x, W, b', 'B. only x', 'C. only prediction', 'D. x and label'), 'correct' => 1, 'hint' => 'Question d’examen de Stanford : choisis la bonne proposition, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : B. Only the placeholder x is required to compute prediction .

label is only required to compute cross entropy and train op . W, b and

prediction are not placeholders.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — h] A multi-layer neural network model trained using stochastic gradient descent on the same dataset with different initializations for its parameters is guar-anteed to learn the same parameters. A. True B. False', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : False. The loss function for a multi-layer neural network is non-convex and hence SGD is only guaranteed to converge to a local optimum.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — h] A multi-layer neural network model trained using stochastic gradient descent on the same dataset with different initializations for its parameters is guar-anteed to learn the same parameters. A. True B. False]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — h] A multi-layer neural network model trained using stochastic gradient descent on the same dataset with different initializations for its parameters is guar-anteed to learn the same parameters. A. True B. False', '_recupere_le' => '2026-11-04T19:55:22.833739+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : False. The loss function for a multi-layer neural network is non-convex and hence SGD is only guaranteed to converge to a local optimum.

[Correction officielle MIT : [S')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] If it parses a sentence', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : True. A RIGHT-ARC must be used to link ROOT to a dependent.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas ly, a transition-based dependency parser must use a right-arc transition at least once. a. true b. false', 'L\'inverse de ly, a transition-based dependency parser must use a right-arc transition at least once. a. true b. false', 'Impossible à déterminer', 'ly, a transition-based dependency parser must use a RIGHT-ARC transition at least once. A. True B. False'), 'correct' => 3, 'answer' => 'ly, a transition-based dependency parser must use a RIGHT-ARC transition at least once. A. True B. False', '_recupere_le' => '2026-11-04T19:55:22.833830+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — j] Stochastic gradient descent results in a smoother convergence plot (loss vs epochs) as compared to batch gradient descent. A. True B. False', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : False. SGD results in noisier convergence plots compared to batch gradient descent.

# 2. Short questions (24 points)

Page 4 Please write answers to the following questions in a sentence or two. Each part is worth 6 points. (a) Dependency Parsing

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — j] Stochastic gradient descent results in a smoother convergence plot (loss vs epochs) as compared to batch gradient descent. A. True B. False]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — j] Stochastic gradient descent results in a smoother convergence plot (loss vs epochs) as compared to batch gradient descent. A. True B. False', '_recupere_le' => '2026-11-04T19:55:22.833908+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : False. SGD results in noisier convergence plots compared to batch gradient descent.

# 2. Short questions (24 points)

Page 4 Please write answers to the following quest')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] Can the neural dependency parser we learned in class', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : No. The sentence has a non-projective parse: yesterday is a dependent of saw, while the phrase “which was a Yorkshire terrier” is a dependent of “dog”.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('ly parse the sentence “John saw a dog yesterday which was a Yorkshire terrier.”? Ex-plain.', 'Pas ly parse the sentence “john saw a dog yesterday which was a yorkshire terrier.”? ex-plain.', 'L\'inverse de ly parse the sentence “john saw a dog yesterday which was a yorkshire terrier.”? ex-plain.', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'ly parse the sentence “John saw a dog yesterday which was a Yorkshire terrier.”? Ex-plain.', '_recupere_le' => '2026-11-04T19:55:22.834006+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] What is the ambiguity in parsing the sentence “There’s an awful cost to getting a PhD that no one talks about”?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The phrase “that no one talks about” could either be referring to the cost, “No one talks about the awful cost of getting a PhD” or to the PhD, “Getting a PhD that no one talks about is awfully costly”.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] What is the ambiguity in parsing the sentence “There’s an awful cost to getting a PhD that no one talks about”?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] What is the ambiguity in parsing the sentence “There’s an awful cost to getting a PhD that no one talks about”?', '_recupere_le' => '2026-11-04T19:55:22.834079+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The phrase “that no one talks about” could either be referring to the cost, “No one talks about the awful cost of getting a PhD” or to the PhD, “Getting a PhD that no on')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] Name at least two types of features that would be helpful to provide as input to a neural dependency parser and explain why.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Here are some useful features that are indicative of transition decisions:

• Taking word vectors for ns words from the top of the stack. Helps identify

• Taking word vectors for nb words from the top of the buffer.

• Taking vector representations for words’ POS tags. Helps disam-biguate the role of the word or word sense.

• Taking vector representations for words’ arc-labels.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] Name at least two types of features that would be helpful to provide as input to a neural dependency parser and explain why.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] Name at least two types of features that would be helpful to provide as input to a neural dependency parser and explain why.', '_recupere_le' => '2026-11-04T19:55:22.834152+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Here are some useful features that are indicative of transition decisions:

• Taking word vectors for ns words from the top of the stack. Helps identify

• Taking word v')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — b] Adagrad is a modification to the stochastic gradient descent algorithm used to update parameters. Updates are performed using the following formula: cache i = cache i + ( ∇θi L)2', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : • Adagrad has a decreasing step-size. This allows parameters to change quickly at first and then converge.

• Adagrad has different per-element stepsizes. This allows parameters with small gradients to change more quickly than those with large step-sizes. (c) Consider the sigmoid activation function below:', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('L\'inverse de θi = θi − η∇θi l/ (√cache i + )where θi is the parameter to be updated, ∇θi l is the gradient of the loss (cost) with respect to θi,  is a hyperparameter usually between 10 −8 and 10 −4 and η is a hyperparameter similar to step size in sgd. cache i is initialized to zero at the start of the algorithm. (i) state two differences between adagrad and sgd in terms of step size and (ii) describe what effect they would have. page 5', 'Impossible à déterminer', 'θi = θi − η∇θi L/ (√cache i + )where θi is the parameter to be updated, ∇θi L is the gradient of the loss (cost) with respect to θi,  is a hyperparameter usually between 10 −8 and 10 −4 and η is a hyperparameter similar to step size in SGD. cache i is initialized to zero at the start of the algorithm. (i) State two differences between AdaGrad and SGD in terms of step size and (ii) describe what effect they would have. Page 5', 'Pas θi = θi − η∇θi l/ (√cache i + )where θi is the parameter to be updated, ∇θi l is the gradient of the loss (cost) with respect to θi,  is a hyperparameter usually between 10 −8 and 10 −4 and η is a hyperparameter similar to step size in sgd. cache i is initialized to zero at the start of the algorithm. (i) state two differences between adagrad and sgd in terms of step size and (ii) describe what effect they would have. page 5'), 'correct' => 2, 'answer' => 'θi = θi − η∇θi L/ (√cache i + )where θi is the parameter to be updated, ∇θi L is the gradient of the loss (cost) with respect to θi,  is a hyperparameter usually between 10 −8 and 10 −4 and η is a hyperparameter similar to step size in SGD. cache i is initialized to zero at the start of the algorithm. (i) State two differences between AdaGrad and SGD in terms of step size and (ii) describe what effect they would have. Page 5', '_recupere_le' => '2026-11-04T19:55:22.834402+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] What would the gradient of the sigmoid be with respect to an input that is very large?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Because the sigmoid is almost flat for very large values, its gra-dient will be almost 0.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] What would the gradient of the sigmoid be with respect to an input that is very large?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] What would the gradient of the sigmoid be with respect to an input that is very large?', '_recupere_le' => '2026-11-04T19:55:22.834466+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Because the sigmoid is almost flat for very large values, its gra-dient will be almost 0.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] Why might this be a problem for training neural networks?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : If weights become saturated during a particular training epoch, the small gradients make it very hard to change weights thereafter: in other words, it makes training much much slower.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] Why might this be a problem for training neural networks?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] Why might this be a problem for training neural networks?', '_recupere_le' => '2026-11-04T19:55:22.834516+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : If weights become saturated during a particular training epoch, the small gradients make it very hard to change weights thereafter: in other words, it makes training muc')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] How does the ReLU activation ReLU( z) = max(0 , z ) solve this prob-lem?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Because ReLU activations are linear, they do not saturate for large (positive) values, and hence freely allow gradients to change weights in the network. However, they do not solve the problem for large negative weights and ReLU units can “die” if a gradient update moves parameters into the flat region. (d) A popular model used for sentiment classification is an LSTM model: Page 6 The movie was okay LSTM LSTM LSTM LSTM Softmax y

This model inputs word vectors to the LSTM model at each time step and uses the last hidden state vector to predict the sentiment label ( y). Recall that in assignment 1 we used a simple “bag-of-vectors” model for sentiment classification: we used the average of all the word vectors in a sentence to predict the sentiment label.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] How does the ReLU activation ReLU( z) = max(0 , z ) solve this prob-lem?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] How does the ReLU activation ReLU( z) = max(0 , z ) solve this prob-lem?', '_recupere_le' => '2026-11-04T19:55:22.834577+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Because ReLU activations are linear, they do not saturate for large (positive) values, and hence freely allow gradients to change weights in the network. However, they d')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] Name at least one benefit of the LSTM model over the bag-of-vectors model.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The LSTM model is able to integrate information from word ordering, e.g. “this was not an amazing fantastic movie” while the bag-of-vectors model can not.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] Name at least one benefit of the LSTM model over the bag-of-vectors model.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] Name at least one benefit of the LSTM model over the bag-of-vectors model.', '_recupere_le' => '2026-11-04T19:55:22.834656+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The LSTM model is able to integrate information from word ordering, e.g. “this was not an amazing fantastic movie” while the bag-of-vectors model can not.

[Correction o')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] If we chose to update our word vectors when training the LSTM model on sentiment classification data, how would these word vectors differ from ones not updated during training? Explain with an example. Assume that the word vectors of the LSTM model were initialized using GloVe or word2vec.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The word vectors learned using this method can capture more sentiment information. In the word2vec models that depend on co-occurrence counts, words like ‘good’ or ‘bad’ have very similar representations; repre-sentations learned through a sentiment classifier would learn different em-beddings.

# 3. Feedforward neural network language models (18 points)

A feedforward neural network language model (NNLM) can be used as another archi-tecture for training word vectors. This model tries to predict a word given the N words that precede it. To do so, we concatenate the word vectors of N previous words and send them through a single hidden layer of size H with a tanh nonlinearity and use a softmax layer to make a prediction of the current word. The size of the vocabulary is

V . The model is trained using a cross entropy loss for the current word. Let the word vectors of the N previous words be x1, x2, . . . , xN , each a column vector of dimension D, and let y be the one-hot vector for the current word. The network is specified by the equations below: The dimensions of our parameters and variables are x ∈ R(N ·D), W ∈ RH×(N ·D), b ∈

RH , h ∈ RH , U ∈ RV ×H , d ∈ RV , ˆy ∈ RV .Page 7 Green eggs and

x1 x2 x3

h

ˆy

x =



x1

x2

...

xN



h = tanh( W x + b)ˆy = softmax( U h + d)

J = CE( y, ˆy)

CE = − ∑

> i

yi log(ˆ yi).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] If we chose to update our word vectors when training the LSTM model on sentiment classification data, how would these word vectors differ from ones not updated during training? Explain with an example. Assume that the word vectors of the LSTM model were initialized using GloVe or word2vec.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] If we chose to update our word vectors when training the LSTM model on sentiment classification data, how would these word vectors differ from ones not updated during training? Explain with an example. Assume that the word vectors of the LSTM model were initialized using GloVe or word2vec.', '_recupere_le' => '2026-11-04T19:55:22.834778+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The word vectors learned using this method can capture more sentiment information. In the word2vec models that depend on co-occurrence counts, words like ‘good’ or ‘bad’')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] State two important differences between NNLM the CBOW model we learned in class. Explain how each might affect the word vectors learned.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : • The CBOW is trained to predict a center word given a context window that extends on both sides, while word vectors learned by NNLM do not capture the context to the right of the word. Thus, the NNLM may not differentiate “word (carefully)” from “word (puzzle)”.

• The CBOW model simply uses the sum of context words, while the NNLM model combines context words non-linearly. Thus the NNLM can learn to treat “not good to” differently from “good to not”, etc. (b)

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] State two important differences between NNLM the CBOW model we learned in class. Explain how each might affect the word vectors learned.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] State two important differences between NNLM the CBOW model we learned in class. Explain how each might affect the word vectors learned.', '_recupere_le' => '2026-11-04T19:55:22.834853+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : • The CBOW is trained to predict a center word given a context window that extends on both sides, while word vectors learned by NNLM do not capture the context to the ri')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — i] What is the complexity of forward propagation in an NNLM for a', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The forward propagation complexity for an NNLM is N × D for concatenating the word vectors, N × D × H to compute h and H × V to compute ˆ y from h: in total, O(N DH + HV ). Typically, V  N D , so the latter term dominates the forward propagation computation.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('single training example?', 'Pas single training example?', 'L\'inverse de single training example?', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'single training example?', '_recupere_le' => '2026-11-04T19:55:22.834929+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] Describe at least one way to change the model that would reduce this complexity.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The complexity can be reduced by using negative sampling to compute the softmax or using the hierarchical softmax.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] Describe at least one way to change the model that would reduce this complexity.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — ii] Describe at least one way to change the model that would reduce this complexity.', '_recupere_le' => '2026-11-04T19:55:22.834995+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The complexity can be reduced by using negative sampling to compute the softmax or using the hierarchical softmax.

[Correction officielle MIT : [Stanford — question d’e')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] What is the gradient of J with respect to x, ∂J ∂x ? Hint: tanh( z)′ =1 − tanh( z)2.Page 8', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Let z1 = xW + b and z2 = hU + d.

δ1 = ∂CE ∂ ˆy = (ˆ y − y)

δ2 = ∂CE ∂h = δ1

∂z 2

∂h = U T δ1

δ3 = ∂CE ∂z 1

= δ2

∂h ∂z 1

= δ2 ◦ (1 − tanh( z1)2)

∂CE ∂x = δ3

∂z 1

∂x = W T δ3

# 4. Autoencoders (18 points)

In class, we’ve learned that one way to combine word vectors is to simply add them together. In this question, we’ll explore another approach: using an autoencoder.

Figure 2: Illustration of an autoencoder unit to combine two vectors In the autoencoder, two input word vectors x1, x2 ∈ RDx×1 are first concatenated into a single vector x =

[x1

x2

]

∈ R2Dx×1, and the parent vector p can be computed as:

p = ReLU( W1x + b1) ∈ RDp×1 ReLU( x) = max(0 , x ),

where W1 can be decomposed as:

W1 = [W11 W12

] W1x = W11 x1 + W12 x2.

During training, we use the parent vector p to reconstruct the input vectors :

x′ =

[x′

> 1

x′

> 2

]

= W2p + b2 ∈ R2Dx×1

Page 9 where x′

> 1

, x′

> 2

∈ RDx×1 are the reconstructions. Correspondingly, a reconstruction loss

that computes the Euclidean distance between inputs and reconstructions is used during training:

J1 = 12|| x′ − x|| 2 ∈ R.

For sentiment classification, the parent vector is used to predict a sentiment class ˆy for the pair of the input words:

ˆy = W3p + b3 ∈ RDc×1,

where Dc = 3 is the number of sentiment classes (‘positive’, ‘neutral’ and ‘negative’). Here, the network is also trained using a cross-entropy loss:

J2 = CE (y, ˆy) ∈ R,

where y ∈ RDc×1 is the one-hot label vector with yk = 1. In total, the network is trained using the loss J = J1 + J2.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] What is the gradient of J with respect to x, ∂J ∂x ? Hint: tanh( z)′ =1 − tanh( z)2.Page 8]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] What is the gradient of J with respect to x, ∂J ∂x ? Hint: tanh( z)′ =1 − tanh( z)2.Page 8', '_recupere_le' => '2026-11-04T19:55:22.835067+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Let z1 = xW + b and z2 = hU + d.

δ1 = ∂CE ∂ ˆy = (ˆ y − y)

δ2 = ∂CE ∂h = δ1

∂z 2

∂h = U T δ1

δ3 = ∂CE ∂z 1

= δ2

∂h ∂z 1

= δ2 ◦ (1 − tanh( z1)2)

∂CE ∂x = δ3

∂z')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] Give at least one example of how the sentiment predictions made by an autoencoder model would differ from one made using a bag-of-vectors model like the one in assignment 1.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The autoencoder model described above allows us to predict that “not bad” is actually neutral or positive, while the bag-of-vectors model would predict a more negative class.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] Give at least one example of how the sentiment predictions made by an autoencoder model would differ from one made using a bag-of-vectors model like the one in assignment 1.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] Give at least one example of how the sentiment predictions made by an autoencoder model would differ from one made using a bag-of-vectors model like the one in assignment 1.', '_recupere_le' => '2026-11-04T19:55:22.835152+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The autoencoder model described above allows us to predict that “not bad” is actually neutral or positive, while the bag-of-vectors model would predict a more negative c')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — b] How do the reconstructed vectors and reconstruction loss help in learning the parent representation?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The reconstruction loss prevents the network from ignoring the con-tribution of one of x1 or x2. In other words, it forces the network to capture the joint ‘meaning’ of x1 and x2.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — b] How do the reconstructed vectors and reconstruction loss help in learning the parent representation?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — b] How do the reconstructed vectors and reconstruction loss help in learning the parent representation?', '_recupere_le' => '2026-11-04T19:55:22.835233+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The reconstruction loss prevents the network from ignoring the con-tribution of one of x1 or x2. In other words, it forces the network to capture the joint ‘meaning’ of')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] i. What is the shape of each weight and bias term: W1, W 2, W 3, b1, b2, b3?ii. How many parameters does the model have in total?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Shapes of all terms:

W1 ∈ RDp×2Dx b1 ∈ RDp×1

W2 ∈ R2Dx×Dp b2 ∈ R2Dx×1

W3 ∈ RDc×Dp b3 ∈ RDc×1

Number of parameters = 4 DxDp + Dp + 2 Dx + DpDc + Dc

Page 10 (d) Compute the following gradients for the reconstruction loss :

Hint: You can use the following notation

1{x > 0} =

{

1, if x > 00, otherwise

Using it on a matrix would perform an element-wise operation, e.g.

1

{[ 1 0

−1 3

]

> 0

}

=

[1 00 1

]

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] i. What is the shape of each weight and bias term: W1, W 2, W 3, b1, b2, b3?ii. How many parameters does the model have in total?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — c] i. What is the shape of each weight and bias term: W1, W 2, W 3, b1, b2, b3?ii. How many parameters does the model have in total?', '_recupere_le' => '2026-11-04T19:55:22.835314+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : Shapes of all terms:

W1 ∈ RDp×2Dx b1 ∈ RDp×1

W2 ∈ R2Dx×Dp b2 ∈ R2Dx×1

W3 ∈ RDc×Dp b3 ∈ RDc×1

Number of parameters = 4 DxDp + Dp + 2 Dx + DpDc + Dc

Page 10 (d) Compu')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — v] ∂J 1', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : Let h = xW1 + b1. ◦ denotes element-wise multiplication.

J1 = 12|| x′ − x|| 2

δ1 = ∂J 1

∂p = W T

> 2

(x′ − x)

δ2 = ∂J 1

∂h = δ1 ◦ 1{h > 0}

∂J 1

∂W 1

= δ2xT , ∂J 1

∂b1

= δ2, ∂J 1

∂x1

= ( W T

> 1

δ2)[1: Dx] = W T

> 11

δ2', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas > ∂x1

=you can use the space below as scratch space.', 'L\'inverse de > ∂x1

=you can use the space below as scratch space.', '> ∂x1

=You can use the space below as scratch space.', 'Impossible à déterminer'), 'correct' => 2, 'answer' => '> ∂x1

=You can use the space below as scratch space.', '_recupere_le' => '2026-11-04T19:55:22.835384+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — e] How would you construct a network using only copies of the autoencoder above to predict a sentiment label for a whole sentence, not just a pair of words? Remember that each sentence could be of arbitrary length.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : We can combine the vectors recursively by combining every subse-quent pair of words, and then combining each pair of parent vectors, etc. We can also combine the vectors linearly by combining the first two words to get a parent vector, followed by combining every subsequent word with the parent vector. We considered answers like averaging each parent vector to be incorrect because this adds mean-pooling layer to the network. However, we considered answers Page 11 like averaging the predictions made on every pair of words to still be correct (though not preferable) because such a network does not use any other element than the autoencoders themselves.

# 5. Recurrent neural networks (20 points)

Recall that a recurrent neural network (RNN) takes in an input vector xt and a state vector ht−1 and returns a new state vector ht and an output vector yt:

ht = f (w1xt + w2ht−1 + b2)

yt = g(w3ht + b3),

where f and g are activations functions.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — e] How would you construct a network using only copies of the autoencoder above to predict a sentiment label for a whole sentence, not just a pair of words? Remember that each sentence could be of arbitrary length.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — e] How would you construct a network using only copies of the autoencoder above to predict a sentiment label for a whole sentence, not just a pair of words? Remember that each sentence could be of arbitrary length.', '_recupere_le' => '2026-11-04T19:55:22.835482+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : We can combine the vectors recursively by combining every subse-quent pair of words, and then combining each pair of parent vectors, etc. We can also combine the vectors')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — a] The following diagram depicts a single RNN unit, where xt, h t−1, h t and

yt are all scalars, as a state machine:

Suppose that f is a binary threshold unit and g is a linear unit:

f (x) =

{

0 if x < 01 if x ≥ 0

g(x) = x.

Fill in weights ( w1, w 2, w 3), biases ( b1, b 2) so that the RNN initially outputs 0, but as soon as it receives an input of 1, it switches to outputting 1 for all subsequent time steps. For instance, the input 0001010 produces the output 0001111. The hidden unit has an initial value of 0. You don’t need to provide an explanation, but doing so may help you receive partial credit.

Hint: In one possible', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : There are many possible solutions, but only one main scenario: the output unit must predict the same as the hidden state. This requires that:

b3 = 0

w3 + b3 = 1

b2 < 0

w2 + b2 ≥ 0

w1 + b2 ≥ 0,

so values like w1 = 1, w2 = 1, b2 = −1, w3 = 1, b3 = 0 would be considered correct. Unfortunately, the original hint we provided was wrong given that the initial value of the hidden state is 0: there is no value of ht for which the unit can flip from 0 to 1 at the start, when the input is 0 AND flip from 1 to 0 when input is 1 and stay there. When grading this question, we have considered parameters that agree with the hint, i.e. w3 = −1, b3 = 1, to also be correct. The remaining parameters were partially marked if (a) you stated that h0 = 1 and had consistent parameters:

b3 = 1

w3 + b3 = 0

b2 < 0

w2 + b2 ≥ 0

w1 + w2 + b2 < 0,

OR (b) reasoned that no values of w1, w 2, b 2 are possible. (b) Now suppose that f is a sigmoid unit and that the input is always 0. The following diagram shows how the next state ht+1 changes with the current state ht when

w2 = 3 and b2 = −1, i.e. ht+1 = σ(3 ht − 1). The diagram also shows that ht+1 = ht

when ht = 0 .80.', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array(', the hidden unit has an activation ht = 0 until there’s an input xt = 1, at which point it switches to maintaining an activation of 1 forever. The output unit always predicts the same as the hidden unit, i.e. yt = ht.

Page 12', 'Impossible à déterminer', 'Pas , the hidden unit has an activation ht = 0 until there’s an input xt = 1, at which point it switches to maintaining an activation of 1 forever. the output unit always predicts the same as the hidden unit, i.e. yt = ht.

page 12', 'L\'inverse de , the hidden unit has an activation ht = 0 until there’s an input xt = 1, at which point it switches to maintaining an activation of 1 forever. the output unit always predicts the same as the hidden unit, i.e. yt = ht.

page 12'), 'correct' => 0, 'answer' => ', the hidden unit has an activation ht = 0 until there’s an input xt = 1, at which point it switches to maintaining an activation of 1 forever. The output unit always predicts the same as the hidden unit, i.e. yt = ht.

Page 12', '_recupere_le' => '2026-11-04T19:55:22.835870+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] What would ht+1 look like as we take increasingly longer sequences, i.e. t → ∞ ?', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : ht+1 would converge to 0 .80 as t → ∞ .

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] What would ht+1 look like as we take increasingly longer sequences, i.e. t → ∞ ?]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] What would ht+1 look like as we take increasingly longer sequences, i.e. t → ∞ ?', '_recupere_le' => '2026-11-04T19:55:22.835943+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : ht+1 would converge to 0 .80 as t → ∞ .

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — iii] What would ht+1 lo')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — v] For what range of initial values h0, would this network experience Page 13 vanishing gradients for long sequences? All', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : The plot above shows how ht is mapped to ht+1 . Whenever

ht < 0.8, the graph shows that ht+1 is greater than ht. Similarly, whenever

ht > 0.8, the graph shows that ht+1 is less than ht. This shows that as the

t → ∞ , ht will converge to ht+1 .In the long term, the gradients experienced by the network, will converge to the gradients at ht = 0 .8, which is clearly less than 1 (because it cuts the line ht = ht+1 with a slope less than 1). At each time step, the net-works’ gradients will be multiplied by this value and hence the network will experience vanishing gradients irrespective of where it started from.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — v] For what range of initial values h0, would this network experience Page 13 vanishing gradients for long sequences? All]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — v] For what range of initial values h0, would this network experience Page 13 vanishing gradients for long sequences? All', '_recupere_le' => '2026-11-04T19:55:22.836014+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : The plot above shows how ht is mapped to ht+1 . Whenever

ht < 0.8, the graph shows that ht+1 is greater than ht. Similarly, whenever

ht > 0.8, the graph shows that ht+')),
							array('question' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — vi] We have learned in class that ReLUs are good at preserving gradients in deep neural networks. Would it be wise to replace the sigmoid activation above with a ReLU activation unit? Explain.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : No. When ht > 13 , then ReLU unit has a slope of 3 and would experience exploding gradients. When ht < 13 , the network would experi-ence vanishing gradients. Page 14

[Correction officielle MIT : [Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — vi] We have learned in class that ReLUs are good at preserving gradients in deep neural networks. Would it be wise to replace the sigmoid activation above with a ReLU activation unit? Explain.]', 'source' => 'Stanford University, CS224N Natural Language Processing — Winter 2018 midterm exam and practice midterms, with the official solutions (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] [cs224n-practice-midterm-3-sol — vi] We have learned in class that ReLUs are good at preserving gradients in deep neural networks. Would it be wise to replace the sigmoid activation above with a ReLU activation unit? Explain.', '_recupere_le' => '2026-11-04T19:55:22.836104+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : No. When ht > 13 , then ReLU unit has a slope of 3 and would experience exploding gradients. When ht < 13 , the network would experi-ence vanishing gradients. Page 14

[')),
						),
					),
				),
			),
		);
	}
}
