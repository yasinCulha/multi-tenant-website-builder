<footer class="cb-footer">
    <div class="cb-container cb-footer__inner">
        <div>
            <strong>{{ $company->name ?? data_get($settings ?? [], 'general.company_name', 'Firma Adi') }}</strong>
            <p>{{ data_get($settings ?? [], 'footer.copyright_text', 'Tum haklari saklidir.') }}</p>
        </div>
        <div class="cb-footer__links">
            <a href="#ana-sayfa">Anasayfa</a>
            <a href="#hakkimizda">Hakkimizda</a>
            <a href="#iletisim">Iletisim</a>
        </div>
    </div>
</footer>
