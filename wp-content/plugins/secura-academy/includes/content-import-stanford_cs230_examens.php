<?php
/**
 * Questions importees — Stanford CS230 Deep Learning — midterm (Winter Quarter 2021)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : Aucune licence explicite publiee sur ces pages
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)
 */
if ( ! function_exists( 'seca_import_stanford_cs230_examens' ) ) {
	function seca_import_stanford_cs230_examens() {
		return array(
			'source' => array('id' => 'stanford-cs230-examens', 'nom' => 'Stanford CS230 Deep Learning — midterm (Winter Quarter 2021)', 'url' => 'https://cs230.stanford.edu/files/cs230exam_win21_soln.pdf', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'attribution' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[Stanford — question d’examen, en anglais] Your model for classifying different dog species is getting a high training set error. Which of the followings are promising things to try to improve your classifier?
(i) Use a bigger neural network
(ii) Get more training data
(iii) Increase the regularization parameter lambda
(iv) Increase the parameter keep prob in dropout layer (assume the classifier has dropout layers)', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (i), (iv).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Your model for classifying different dog species is getting a high training set error. Which of the followings are promising things to try to improve your classifier?
(i) Use a bigger neural network
(ii) Get more training data
(iii) Increase the regularization parameter lambda
(iv) Increase the parameter keep prob in dropout layer (assume the classifier has dropout layers)]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] Your model for classifying different dog species is getting a high training set error. Which of the followings are promising things to try to improve your classifier?
(i) Use a bigger neural network
(ii) Get more training data
(iii) Increase the regularization parameter lambda
(iv) Increase the parameter keep prob in dropout layer (assume the classifier has dropout layers)', '_recupere_le' => '2026-11-04T19:55:22.838432+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (i), (iv).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Your model for classifying different dog species is getting a high training set error')),
							array('question' => '[Stanford — question d’examen, en anglais] Which of the followings are true about Batch Normalization?
(i) Batch Norm layers are skipped at test time because a single test example cannot be normalized.
(ii) Its learnable parameters can only be learned using gradient descent or mini-batch gradient descent, but not other optimization algorithms.
(iii) It helps speed up learning in the network.
(iv) It introduces noise to a hidden layer\'s activation, because the mean and the standard deviation are estimated with a mini-batch of data.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (iii), (iv).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Which of the followings are true about Batch Normalization?
(i) Batch Norm layers are skipped at test time because a single test example cannot be normalized.
(ii) Its learnable parameters can only be learned using gradient descent or mini-batch gradient descent, but not other optimization algorithms.
(iii) It helps speed up learning in the network.
(iv) It introduces noise to a hidden layer\'s activation, because the mean and the standard deviation are estimated with a mini-batch of data.]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] Which of the followings are true about Batch Normalization?
(i) Batch Norm layers are skipped at test time because a single test example cannot be normalized.
(ii) Its learnable parameters can only be learned using gradient descent or mini-batch gradient descent, but not other optimization algorithms.
(iii) It helps speed up learning in the network.
(iv) It introduces noise to a hidden layer\'s activation, because the mean and the standard deviation are estimated with a mini-batch of data.', '_recupere_le' => '2026-11-04T19:55:22.838607+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (iii), (iv).

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Which of the followings are true about Batch Normalization?
(i) Batch Norm layers a')),
							array('question' => '[Stanford — question d’examen, en anglais] If your input image is 64x64x16, how many parameters are there in a single 1x1 convolution filter, including bias?
(i) 2
(ii) 17
(iii) 4097
(iv) 1', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (ii). The filter contains 16 parameters in the weight and 1 in the bias.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] If your input image is 64x64x16, how many parameters are there in a single 1x1 convolution filter, including bias?
(i) 2
(ii) 17
(iii) 4097
(iv) 1]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] If your input image is 64x64x16, how many parameters are there in a single 1x1 convolution filter, including bias?
(i) 2
(ii) 17
(iii) 4097
(iv) 1', '_recupere_le' => '2026-11-04T19:55:22.838707+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (ii). The filter contains 16 parameters in the weight and 1 in the bias.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] If your input image is')),
							array('question' => '[Stanford — question d’examen, en anglais] Which one of the following statements on initialization is false?
(i) The variances of layer outputs remain unchanged during training when Xavier initialization is used.
(ii) Initializing all weights to a positive constant value isn\'t sufficient to break learning symmetry during training.
(iii) Different activation functions may benefit from different types of initializations.
(iv) It\'s possible to break symmetry by initializing weights to be sampled uniformly from the set {-1,1}.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (i) Xavier initialization guarantees the variances are standardized at the start, but this can change over the course of training

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Which one of the following statements on initialization is false?
(i) The variances of layer outputs remain unchanged during training when Xavier initialization is used.
(ii) Initializing all weights to a positive constant value isn\'t sufficient to break learning symmetry during training.
(iii) Different activation functions may benefit from different types of initializations.
(iv) It\'s possible to break symmetry by initializing weights to be sampled uniformly from the set {-1,1}.]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] Which one of the following statements on initialization is false?
(i) The variances of layer outputs remain unchanged during training when Xavier initialization is used.
(ii) Initializing all weights to a positive constant value isn\'t sufficient to break learning symmetry during training.
(iii) Different activation functions may benefit from different types of initializations.
(iv) It\'s possible to break symmetry by initializing weights to be sampled uniformly from the set {-1,1}.', '_recupere_le' => '2026-11-04T19:55:22.838866+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (i) Xavier initialization guarantees the variances are standardized at the start, but this can change over the course of training

[Correction officielle MIT : [Stanford')),
							array('question' => '[Stanford — question d’examen, en anglais] The shape of your input image is (nh,nw,nc); the convolution layer uses a 1-by-1 filter with stride = 1 and padding = 0. Which of the following statements are', 'mode' => 'choice', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (i), (ii). Maxpooling operates on the height and width dimensions of an image. Convolution reduces the input channels.', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'choices' => array('Pas ?
(i) you can reduce nc by using 1x1 convolution. however, you cannot change nh, nw. how large is the support (the set of image pixels which activate) of a neuron in the 4th non-image layer of this network?
(ii) you can use a standard maxpooling to reduce nh, nw, but not nc.
(iii) you can use a 1x1 convolution to reduce nh, nw, nc.
(iv) you can use maxpooling to reduce nh, nw, nc.', '?
(i) You can reduce nc by using 1x1 convolution. However, you cannot change nh, nw. How large is the support (the set of image pixels which activate) of a neuron in the 4th non-image layer of this network?
(ii) You can use a standard maxpooling to reduce nh, nw, but not nc.
(iii) You can use a 1x1 convolution to reduce nh, nw, nc.
(iv) You can use maxpooling to reduce nh, nw, nc.', 'L\'inverse de ?
(i) you can reduce nc by using 1x1 convolution. however, you cannot change nh, nw. how large is the support (the set of image pixels which activate) of a neuron in the 4th non-image layer of this network?
(ii) you can use a standard maxpooling to reduce nh, nw, but not nc.
(iii) you can use a 1x1 convolution to reduce nh, nw, nc.
(iv) you can use maxpooling to reduce nh, nw, nc.', 'Impossible à déterminer'), 'correct' => 1, 'answer' => '?
(i) You can reduce nc by using 1x1 convolution. However, you cannot change nh, nw. How large is the support (the set of image pixels which activate) of a neuron in the 4th non-image layer of this network?
(ii) You can use a standard maxpooling to reduce nh, nw, but not nc.
(iii) You can use a 1x1 convolution to reduce nh, nw, nc.
(iv) You can use maxpooling to reduce nh, nw, nc.', '_recupere_le' => '2026-11-04T19:55:22.839088+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[Stanford — question d’examen, en anglais] Which of the following statements on regularization are true?
(i) Using L-2 regularization enforces a Laplacian prior on your network weights.
(ii) Batch normalization can have an implicit regularizing effect, especially with smaller minibatches.
(iii) Layernorm\'s regularization effect increases with larger batch sizes.
(iv) Your choice of regularization factor can cause your model to underfit.', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (ii), (iv). (i): L-2 regularization enforces a Gaussian prior on weights (ii) Smaller minibatches result in noisier estimates of the minibatch mean and variance - this has been emprically shown to improve generation in some cases (iii) Layer normalization doesn\'t depend on minibatch size and hasn\'t been shown to theoretically or empirically aid generalization (iv) Setting an extremely large factor pushes learned weights close to zero

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Which of the following statements on regularization are true?
(i) Using L-2 regularization enforces a Laplacian prior on your network weights.
(ii) Batch normalization can have an implicit regularizing effect, especially with smaller minibatches.
(iii) Layernorm\'s regularization effect increases with larger batch sizes.
(iv) Your choice of regularization factor can cause your model to underfit.]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] Which of the following statements on regularization are true?
(i) Using L-2 regularization enforces a Laplacian prior on your network weights.
(ii) Batch normalization can have an implicit regularizing effect, especially with smaller minibatches.
(iii) Layernorm\'s regularization effect increases with larger batch sizes.
(iv) Your choice of regularization factor can cause your model to underfit.', '_recupere_le' => '2026-11-04T19:55:22.839253+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (ii), (iv). (i): L-2 regularization enforces a Gaussian prior on weights (ii) Smaller minibatches result in noisier estimates of the minibatch mean and variance - this h')),
							array('question' => '[Stanford — question d’examen, en anglais] What is the benefit of using Momentum optimization?
(i) Simple update rule with minimal hyperparameters
(ii) Helps get weights out of local minima
(iii) Effectively scales the learning rate to act the same amount across all dimensions
(iv) Combines the benefits of multiple optimization methods', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (ii). The choices describe SGD, Momentum, RMSProp, and Adam, respectively.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] What is the benefit of using Momentum optimization?
(i) Simple update rule with minimal hyperparameters
(ii) Helps get weights out of local minima
(iii) Effectively scales the learning rate to act the same amount across all dimensions
(iv) Combines the benefits of multiple optimization methods]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] What is the benefit of using Momentum optimization?
(i) Simple update rule with minimal hyperparameters
(ii) Helps get weights out of local minima
(iii) Effectively scales the learning rate to act the same amount across all dimensions
(iv) Combines the benefits of multiple optimization methods', '_recupere_le' => '2026-11-04T19:55:22.839359+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (ii). The choices describe SGD, Momentum, RMSProp, and Adam, respectively.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] What is the benefit o')),
							array('question' => '[Stanford — question d’examen, en anglais] Which of the below can you implement to solve the exploding gradient problem?
(i) Use SGD optimization
(ii) Oversample minority classes
(iii) Increase the batch size
(iv) Impose gradient clipping', 'mode' => 'text', 'hint' => 'Question d’examen de Stanford : rédige ta réponse, puis la correction officielle de Stanford s’affiche.', 'explanation' => 'Corrigé officiel de Stanford : (iv). Gradient clipping is an easy way to keep gradient values well-behaved. The other options do not help the problem at all.

[Correction officielle MIT : [Stanford — question d’examen, en anglais] Which of the below can you implement to solve the exploding gradient problem?
(i) Use SGD optimization
(ii) Oversample minority classes
(iii) Increase the batch size
(iv) Impose gradient clipping]', 'source' => 'Stanford University, CS230 Deep Learning, Winter Quarter 2021 — midterm et corrigé officiel (Stanford)', 'licence' => 'Aucune licence explicite publiee sur ces pages', 'xp' => 20, 'answer' => '[Stanford — question d’examen, en anglais] Which of the below can you implement to solve the exploding gradient problem?
(i) Use SGD optimization
(ii) Oversample minority classes
(iii) Increase the batch size
(iv) Impose gradient clipping', '_recupere_le' => '2026-11-04T19:55:22.839445+00:00Z', '_strategie' => 'mode_texte_ouvert', 'answers' => array('Corrigé officiel de Stanford : (iv). Gradient clipping is an easy way to keep gradient values well-behaved. The other options do not help the problem at all.

[Correction officielle MIT : [Stanford —')),
						),
					),
				),
			),
		);
	}
}
