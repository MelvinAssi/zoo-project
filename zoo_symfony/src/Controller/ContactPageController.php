<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactPageController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, ValidatorInterface $validator)
    {
        $errors = [];

        if ($request->isMethod('POST')) {
            // CSRF protection
            /*
            if (!$this->isCsrfTokenValid('contact_form', $request->request->get('_token'))) {
                $errors[] = 'Jeton CSRF invalide.';
            }
            */
            $data = $request->request->all();

            $constraints = new Assert\Collection([
                'name' => [new Assert\NotBlank(), new Assert\Length(['min' => 2])],
                'email' => [new Assert\NotBlank(), new Assert\Email()],
                'subject' => [new Assert\NotBlank()],
                'message' => [new Assert\NotBlank(), new Assert\Length(['min' => 10])],
            ]);

            $violations = $validator->validate($data, $constraints);

            foreach ($violations as $violation) {
                $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }

            if (empty($errors)) {
                $this->addFlash('success', 'Message envoyé !');
                return $this->redirectToRoute('app_contact');
            }
        }

        return $this->render('contact/contactPage.html.twig', [
            'errors' => $errors,
            'name' => $request->request->get('name'),
            'email' => $request->request->get('email'),
            'subject' => $request->request->get('subject'),
            'message' => $request->request->get('message'),
        ]);
    }
}
