<?php
/**
 * Questions importees — MIT OpenCourseWare — 1.124J Foundations of Software Engineering (Fall 2000)
 *
 * Genere par tools/import-questions.py : ne pas editer a la main.
 * Licence : CC BY-NC-SA 4.0
 * Usage commercial : NON autorise (licence NC ou contenu non reutilisable) — le site reste gratuit pour les eleves
 * Attribution : MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)
 */
if ( ! function_exists( 'seca_import_mit_ocw_1_124j_examens' ) ) {
	function seca_import_mit_ocw_1_124j_examens() {
		return array(
			'source' => array('id' => 'mit-ocw-1-124j-examens', 'nom' => 'MIT OpenCourseWare — 1.124J Foundations of Software Engineering (Fall 2000)', 'url' => 'https://ocw.mit.edu/courses/1-124j-foundations-of-software-engineering-fall-2000/resources/exams/', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)'),
			'rooms' => array(
				'comment-marche-un-ordinateur-de-la-donnee-au-programme' => array(
					'title' => 'comment-marche-un-ordinateur-de-la-donnee-au-programme',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Use an initialization list in the constructor:
Ball(int r=1) : pi(3.14159f) {
radius = r;
}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('Show how you would initialize the member pi in class Ball.', 'Impossible à déterminer', 'Pas show how you would initialize the member pi in class ball.', 'L\'inverse de show how you would initialize the member pi in class ball.'), 'correct' => 0, 'answer' => 'Show how you would initialize the member pi in class Ball.', '_recupere_le' => '2026-11-04T19:55:22.374958+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : A protected member of a class is a member variable or function, which can only
be accessed within the definition of the class and the definitions of derived
classes. e.g.
class Base {
protected:
int a;
};
class Derived : public Base {
public:
void set(int i) {
a = i; // Example of valid usage.
}
};
void main() {
Derived x;
x.a = 7; // Illegal.
}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('What is a protected member? Give examples of how such a member can
and cannot be used.', 'Pas what is a protected member? give examples of how such a member can
and cannot be used.', 'Impossible à déterminer', 'L\'inverse de what is a protected member? give examples of how such a member can
and cannot be used.'), 'correct' => 0, 'answer' => 'What is a protected member? Give examples of how such a member can
and cannot be used.', '_recupere_le' => '2026-11-04T19:55:22.375053+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : final Color c = p.getBackground();
p.addMouseListener(new MouseAdapter() {
public void mouseEntered(MouseEvent e) {
p.setBackground(Color.gray);
}
public void mouseExited(MouseEvent e) {
p.setBackground(c);
}
});
f.setContentPane(p);
f.setSize(250,250);
f.setVisible(true);
}
}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('Impossible à déterminer', 'L\'inverse de how you would you change the background color of the panel when the mouse moves
over the application\'s window?
mouse out mouse over
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
class main {
public static void main(string args[]) {
jframe f = new jframe();
final jpanel p = new jpanel();', 'How you would you change the background color of the panel when the mouse moves
over the application\'s window?
Mouse out Mouse over
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
class Main {
public static void main(String args[]) {
JFrame f = new JFrame();
final JPanel p = new JPanel();', 'Pas how you would you change the background color of the panel when the mouse moves
over the application\'s window?
mouse out mouse over
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
class main {
public static void main(string args[]) {
jframe f = new jframe();
final jpanel p = new jpanel();'), 'correct' => 2, 'answer' => 'How you would you change the background color of the panel when the mouse moves
over the application\'s window?
Mouse out Mouse over
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
class Main {
public static void main(String args[]) {
JFrame f = new JFrame();
final JPanel p = new JPanel();', '_recupere_le' => '2026-11-04T19:55:22.375191+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : import java.util.*;
class Main {
public static void main(String args[]) {
String str = "Hello 1.124 World!";
StringTokenizer t = new StringTokenizer(str);
String s = t.nextToken();
s = t.nextToken();
float f = Float.parseFloat(s);
}
}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('L\'inverse de show how you would extract the number 1.124 from the string "hello 1.124 world!" and
then store it in a float variable.', 'Pas show how you would extract the number 1.124 from the string "hello 1.124 world!" and
then store it in a float variable.', 'Impossible à déterminer', 'Show how you would extract the number 1.124 from the string "Hello 1.124 World!" and
then store it in a float variable.'), 'correct' => 3, 'answer' => 'Show how you would extract the number 1.124 from the string "Hello 1.124 World!" and
then store it in a float variable.', '_recupere_le' => '2026-11-04T19:55:22.375291+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
				'donnees-et-systemes-organiser-linformation' => array(
					'title' => 'donnees-et-systemes-organiser-linformation',
					'tasks' => array(
						'test' => array(
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Within the public part of the Ball class declaration:
Ball(const Ball& b) : pi(b.pi) {
radius = b.radius;
}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('L\'inverse de write the copy constructor for class ball.', 'Pas write the copy constructor for class ball.', 'Write the copy constructor for class Ball.', 'Impossible à déterminer'), 'correct' => 2, 'answer' => 'Write the copy constructor for class Ball.', '_recupere_le' => '2026-11-04T19:55:22.375345+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : In the public part of the declaration for class Ball:
virtual ~Ball() {}
In the public part for the declaration for class BuckyBall:
~BuckyBall() {}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('L\'inverse de give the definitions of the destructors for the ball and buckyball classes.', 'Impossible à déterminer', 'Give the definitions of the destructors for the Ball and BuckyBall classes.', 'Pas give the definitions of the destructors for the ball and buckyball classes.'), 'correct' => 2, 'answer' => 'Give the definitions of the destructors for the Ball and BuckyBall classes.', '_recupere_le' => '2026-11-04T19:55:22.375402+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : Double buffering is important because it helps to produce a smooth looking
animation that does not flicker. Without double buffering, noticeable
flicker will usually result due to the clearing of the background before an
animation frame is drawn. Double buffering is implemented by performing
all drawing operations for an animation frame (including clearing the
background) in an off-screen image buffer. Once the complete animation
frame has been assembled off-screen, the contents of the image buffer are
copied on to the screen.
The Swing package provides automatic double buffering capabilities by
way of the JComponent class. With the AWT classes, double buffering is
the responsibility of the programmer.', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('L\'inverse de what is double buffering and why is it important in animation? how do the swing
classes differ from the awt classes in this respect?', 'Impossible à déterminer', 'What is double buffering and why is it important in animation? How do the Swing
classes differ from the AWT classes in this respect?', 'Pas what is double buffering and why is it important in animation? how do the swing
classes differ from the awt classes in this respect?'), 'correct' => 2, 'answer' => 'What is double buffering and why is it important in animation? How do the Swing
classes differ from the AWT classes in this respect?', '_recupere_le' => '2026-11-04T19:55:22.375479+00:00Z', '_strategie' => 'separation_enum_solution'),
							array('question' => '[MIT 1.124J — question d’examen, en anglais]', 'mode' => 'choice', 'xp' => 20, 'hint' => 'Question d’examen du MIT : rédige ta réponse, puis la correction officielle du MIT s’affiche.', 'explanation' => 'Corrigé officiel du MIT : void Point::set_coords(int x, int y) {
this->x = x; // or Point::x = x;
this->y = y; // or Point::y = y;
}', 'source' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000 — quiz d’examen et corrigé officiel (MIT EECS)', 'licence' => 'CC BY-NC-SA 4.0', 'attribution' => 'MIT OpenCourseWare, 1.124J Foundations of Software Engineering, Fall 2000', 'choices' => array('Fill in the body of the member function, set_coords, so that it properly sets
the private member data in class Point.', 'Pas fill in the body of the member function, set_coords, so that it properly sets
the private member data in class point.', 'L\'inverse de fill in the body of the member function, set_coords, so that it properly sets
the private member data in class point.', 'Impossible à déterminer'), 'correct' => 0, 'answer' => 'Fill in the body of the member function, set_coords, so that it properly sets
the private member data in class Point.', '_recupere_le' => '2026-11-04T19:55:22.375551+00:00Z', '_strategie' => 'separation_enum_solution'),
						),
					),
				),
			),
		);
	}
}
