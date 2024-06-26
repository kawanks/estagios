<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Estagio;
use App\Service\GeneralSettings;

class justificativa_analise_tecnica extends Mailable
{
    use Queueable, SerializesModels;
    private $estagio;
    private $settings;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Estagio $estagio)
    {
        $this->estagio = $estagio;
        $this->settings = app(GeneralSettings::class);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $to = [$this->estagio->email_de_contato,config('mail.reply_to.address')];

        $subject = $this->estagio->nome . ' - JUSTIFICATIVA DA ANÁLISE TÉCNICA - Setor de Estágios ' . $this->settings->sigla_unidade;

        $text = str_replace('#estagiario_nome#', $this->estagio->nome, $this->settings->justificativa_analise_tecnica);
        $text = str_replace('#analise_tecnica#', $this->estagio->analise_tecnica, $text);
        $text = str_replace('#sigla_unidade#', $this->settings->sigla_unidade, $text);

        return $this->view('emails.justificativa_analise_tecnica')
                    ->to($to)
                    ->subject($subject)
                    ->with([
                        'text' => $text
                    ]);
    }
}
