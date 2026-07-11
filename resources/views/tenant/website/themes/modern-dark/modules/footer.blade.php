<footer class="md-footer">
    <div class="md-container md-footer__inner">
        <div>
            <strong>{{ $company->name ?? data_get($settings ?? [], 'general.company_name', 'Firma Adi') }}</strong>
            <p>{{ data_get($settings ?? [], 'footer.copyright_text', 'Tum haklari saklidir.') }}</p>
        </div>
        <div class="md-footer__links">
            <a href="#ana-sayfa">Home</a>
            <a href="#hakkimizda">About</a>
            <a href="#iletisim">Contact</a>
        </div>
    </div>
</footer>
