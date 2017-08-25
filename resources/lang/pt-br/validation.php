<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => ':attribute deve ser aceito.',
    'active_url'           => ':attribute não é uma URL válida.',
    'after'                => ':attribute deve ser uma data depois de :date.',
    'after_or_equal'       => ':attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => ':attribute deve conter somente letras.',
    'alpha_dash'           => ':attribute deve conter letras, números e traços.',
    'alpha_num'            => ':attribute deve conter somente letras e números.',
    'array'                => ':attribute deve ser um array.',
    'before'               => ':attribute deve ser uma data antes de :date.',
    'before_or_equal'      => ':attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file'    => ':attribute deve estar entre :min e :max kilobytes.',
        'string'  => ':attribute deve estar entre :min e :max caracteres.',
        'array'   => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => ':attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não confere.',
    'date'                 => ':attribute não é uma data válida.',
    'date_format'          => ':attribute não confere com o formato :format.',
    'different'            => ':attribute e :other devem ser diferentes.',
    'digits'               => ':attribute deve ter :digits dígitos.',
    'digits_between'       => ':attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => ':attribute tem dimensões de imagem inválidas.',
    'distinct'             => ':attribute tem um valor duplicado.',
    'email'                => ':attribute deve ser um endereço de e-mail válido.',
    'exists'               => ':attribute selecionado é inválido.',
    'file'                 => ':attribute deve ser um arquivo.',
    'filled'               => ':attribute é um campo obrigatório.',
    'image'                => ':attribute deve ser uma imagem.',
    'in'                   => ':attribute é inválido.',
    'in_array'             => ':attribute não existe em :other.',
    'integer'              => ':attribute deve ser um inteiro.',
    'ip'                   => ':attribute deve ser um endereço IP válido.',
    'json'                 => ':attribute deve ser um JSON válido.',
    'max'                  => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file'    => ':attribute não deve ter mais que :max kilobytes.',
        'string'  => ':attribute não deve ter mais que :max caracteres.',
        'array'   => ':attribute não deve ter mais que :max itens.',
    ],
    'mimes'                => ':attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => ':attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute deve ser no mínimo :min.',
        'file'    => ':attribute deve ter no mínimo :min kilobytes.',
        'string'  => ':attribute deve ter no mínimo :min caracteres.',
        'array'   => ':attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => ':attribute deve ser um número.',
    'present'              => 'O campo :attribute deve ser presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O :attribute é necessário a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same'                 => ':attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => ':attribute deve ser :size.',
        'file'    => ':attribute deve ter :size kilobytes.',
        'string'  => ':attribute deve ter :size caracteres.',
        'array'   => ':attribute deve conter :size itens.',
    ],
    'string'               => ':attribute deve ser uma string',
    'timezone'             => ':attribute deve ser uma timezone válida.',
    'unique'               => ':attribute já está em uso.',
    'uploaded'             => ':attribute falhou ao ser enviado.',
    'url'                  => 'O formato de :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'password'       => 'localized username',

        'attributes'     => [
            'password' => 'localized username',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
     */

    'attributes'           => [
        'id'                              => 'ID',
        'name'                            => 'Nome',
        'email'                           => 'Email',
        'password'                        => 'Senha',
        'trocarsenha'                     => 'Trocar Senha',
        'avatar'                          => 'Foto',
        'remember_token'                  => 'Lembrar Usuário',
        'created_at'                      => 'Data de Criação',
        'updated_at'                      => 'Data de Atualização',
        'roles'                           => 'Funções',
        'criar'                           => 'Criar novo Usuário',
        'editar'                          => 'Editar Usuário :id',
        'listar'                          => 'Listar Usuários',
        'language'                        => 'Idioma',
        'pt-br'                           => 'Português',
        'en'                              => 'Inglês',
        'perfil'                          => 'Perfil Usuário(a) :name',
        'mostrar'                         => 'Usuário(a) :name',
        'password_confirmation'           => 'Confirmação da Senha',
        'display_name'                    => 'Apelido',
        'description'                     => 'Descrição',
        'created_at'                      => 'Data de Criação',
        'updated_at'                      => 'Data de Atualização',
        'permissions'                     => 'Permissões',
        'novafuncao'                      => 'Nova Função',
        'editarfuncao'                    => 'Editar Função',
        'listarfuncao'                    => 'Listar Funções',
        'mostrar'                         => 'Detalhes :name', 'cl_codigo' => 'Código',
        'cl_nome'                         => 'Nome',
        'cl_cpf'                          => 'CPF',
        'cl_fone'                         => 'Telefone',
        'cl_pessoa'                       => 'Pessoa',
        'cl_bloqueado'                    => 'Bloqueado',
        'rc_data_negativado'              => 'Data Negativação',
        'cl_endereco'                     => 'Endereço',
        'cl_numero'                       => 'Número',
        'cl_complemento'                  => 'Complemento',
        'cl_bairro'                       => 'Bairro',
        'cl_cep'                          => 'CEP',
        'cl_cidade'                       => 'Cidade',
        'cl_pais'                         => 'Páis',
        'cl_uf'                           => 'UF',
        'cl_imovel'                       => 'Imóvel',
        'cl_celular'                      => 'Celular',
        'cl_email'                        => 'Email',
        'cl_email_contato'                => 'Email Contato',
        'cl_sememail_autorizado'          => 'Email Autorizado',
        'cl_site'                         => 'Site',
        'cl_sexo'                         => 'Sexo',
        'cl_nascimento'                   => 'Nascimento',
        'cl_desde'                        => 'Cliente Desde',
        'cl_conjuge'                      => 'Conjuge',
        'cl_pai'                          => 'Pai',
        'cl_mae'                          => 'Mãe',
        'cl_estadocivil'                  => 'Estado Civil',
        'cl_serasa_limpo'                 => 'Serasa',
        'cl_pontual'                      => 'Pontual',
        'cl_data_fundacao'                => 'Data Fundação',
        'cl_data_contrato'                => 'Data Contrato',
        'cl_valor_capital'                => 'Valor Capital',
        'cl_fone_confirmado'              => 'Telefone Confirmado',
        'cl_documentos_ok'                => 'Documento ok',
        'cl_historico'                    => 'Histórico',
        'cl_limite_sugerido'              => 'Limíte Sugerido',
        'cl_dataspc'                      => 'Data SPC',
        'cl_validadespc'                  => 'Validade SPC',
        'cl_renda'                        => 'Renda',
        'cl_limitecredito'                => 'Limite de Crédito',
        'cl_refpessoal1'                  => 'Ref.Pessoal 1',
        'cl_fonerefpessoal1'              => 'Ref.Pessoal Fone 1',
        'cl_refpessoal2'                  => 'Ref.Pessoal 2',
        'cl_fonerefpessoal2'              => 'Ref.Pessoal Fone 2',
        'cl_refcomercial1'                => 'Ref.Comercial 1',
        'cl_fonerefcomercial1'            => 'Ref.Comercial Fone 1',
        'cl_refcomercial2'                => 'Ref.Comercial 2',
        'cl_fonerefcomercial2'            => 'Ref.Comercial Fone 2',
        'cl_refbancaria1'                 => 'Ref.Bancária 1',
        'cl_fonerefbancaria1'             => 'Ref.Bancária Fone 1',
        'cl_refbancaria2'                 => 'Ref.Bancária 2',
        'cl_fonerefbancaria2'             => 'Ref.Bancária Fone 2',
        'cl_pendereco'                    => 'Endereço Cobrança',
        'cl_pbairro'                      => 'Bairro Cobrança',
        'cl_pcep'                         => 'CEP Cobrança',
        'cl_pcidade'                      => 'Cidade Cobrança',
        'cl_puf'                          => 'UF Cobrança',
        'cl_pfone'                        => 'Telefone Cobrança',
        'cl_rgie'                         => 'RG',
        'cl_rgdataemissao'                => 'RG data',
        'cl_rgorgaoemissor'               => 'RG Emissor',
        'cl_empresa'                      => 'Empresa onde Trabalha',
        'cl_empresacnpj'                  => 'CNPJ',
        'cl_empresafone'                  => 'Telefone',
        'cl_dataultimacompra'             => 'Ultima Compra',
        'cl_valorultimacompra'            => 'Valor U.Compra',
        'cl_datadevolucao'                => 'Data Devolução',
        'cl_valorcredito'                 => 'Valor Crédito',
        'cl_desconto'                     => 'Desconto',
        'cl_prot'                         => 'Protesto',
        'cl_spc'                          => 'SPC',
        'cl_dias_restantes'               => 'Dias Uteis Restantes',
        'cl_codigorelacionado'            => 'Código Relacionado',
        'cl_tipo_contrato'                => 'Tipo',
        'cl_data_inicio_contrato'         => 'Data Contrato',
        'cl_data_final_contrato'          => 'Final Contrato',
        'cl_dia_faturamento'              => 'Dia Faturamento',
        'cl_valor_contrato'               => 'Valor Contrato',
        'cl_data_reajuste_contrato'       => 'Data Reajuste',
        'cl_percentual_reajuste_contrato' => 'Percentual Reajuste',
        'cl_carteira'                     => 'Carteira',
        'cl_obs'                          => 'Observação',
        'pc_codigo'                       => 'Profissão',
        'pc_codigo2'                      => 'Profissional 2',
        'cl_vip'                          => 'Classificação Cliente',
        'lo_codigo'                       => 'Local',
        'fu_colaborador'                  => 'Colaborador',
        'rt_codigo'                       => 'Rota',
        'st_codigo'                       => 'Status',
        'fu_codigo'                       => 'Usuário',
        'pf_codigo'                       => 'Profissional',
        'cl_senha'                        => 'Senha',
        'cl_ativo'                        => 'Ativo',
        'ln_codigo'                       => 'ln_codigo',
        'cl_certificados'                 => 'Certificados',
        'cl_documentos'                   => 'Documentos',
        'cl_marca'                        => 'Marcar',
        'sql_rowid'                       => 'ID',
        'sql_deleted'                     => 'Excluído',

    ],

];
