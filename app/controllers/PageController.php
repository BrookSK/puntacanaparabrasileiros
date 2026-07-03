<?php
/**
 * Controller de Páginas estáticas (políticas, termos, etc)
 */
class PageController extends Controller
{
    public function privacidade()
    {
        $this->view('site.pages.privacidade', ['pageTitle' => 'Políticas de Privacidade']);
    }

    public function cancelamento()
    {
        $this->view('site.pages.cancelamento', ['pageTitle' => 'Políticas de Cancelamento']);
    }

    public function termos()
    {
        $this->view('site.pages.termos', ['pageTitle' => 'Termos e Condições']);
    }

    public function termosAfiliados()
    {
        $this->view('site.pages.termos-afiliados', ['pageTitle' => 'Termos do Programa de Afiliados']);
    }

    public function cancelamentos()
    {
        $this->view('site.pages.cancelamentos', ['pageTitle' => 'Cancelamentos']);
    }
}
