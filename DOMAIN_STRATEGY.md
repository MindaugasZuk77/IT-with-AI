# Domain Strategy Documentation

## Domenų Strategija / Domain Strategy

### Pagrindinis sprendimas / Main Decision

**itwithai.lt** - Pagrindinis domenas / Primary domain  
**itwithai.com** - Nukreipiamas į .lt / Redirects to .lt

### Implementuoti sprendimai / Implemented Solutions

#### 1. Canonical URLs

- Visi puslapiai nurodo į .lt domeną
- `index_lt.html` -> `https://itwithai.lt/index_lt.html`
- `index_en.html` -> `https://itwithai.lt/index_en.html`

#### 2. Structured Data

- Visi schema.org tagiai nurodo į .lt domeną
- OpenGraph meta tagiai nurodo į .lt domeną
- Twitter Card meta tagiai nurodo į .lt domeną

#### 3. Sitemap konfigūracija

- Pagrindinis sitemap.xml: .lt domenas turi aukščiausią prioritetą (1.0)
- .com domeno puslapiai turi žemą prioritetą (0.1) ir changefreq="never"
- Visos hreflang nuorodos nurodo į .lt domeną

#### 4. Redirects (.htaccess)

```apache
# .com -> .lt redirects
RewriteCond %{HTTP_HOST} ^itwithai\.com$ [NC]
RewriteRule ^(.*)$ https://itwithai.lt/$1 [R=301,L]

RewriteCond %{HTTP_HOST} ^www\.itwithai\.com$ [NC]
RewriteRule ^(.*)$ https://itwithai.lt/$1 [R=301,L]

RewriteCond %{HTTP_HOST} ^www\.itwithai\.lt$ [NC]
RewriteRule ^(.*)$ https://itwithai.lt/$1 [R=301,L]
```

#### 5. Robots.txt

- Pagrindinis robots.txt nurodo tik .lt sitemap
- Atskirac robots-com.txt failas .com domenui

### Failų konfigūracija / File Configuration

#### .lt domenas (pagrindinis):

- `robots.txt` - nurodo į .lt sitemap
- `sitemap.xml` - pagrindinis sitemap su .lt prioritetu
- `index.html` - nukreipia į .lt domeną
- `.htaccess` - redirect taisyklės

#### .com domenas (redirect):

- `robots-com.txt` - redirect domain robots
- `sitemap-redirect.xml` - žemo prioriteto sitemap
- `.htaccess` - visų .com puslapių redirects

### SEO nauda / SEO Benefits

1. **Domain Authority konsolidacija** - viskas koncentruojasi į .lt domeną
2. **Canonical signals** - aiškus ženklas Google, kuris domenas pagrindinis
3. **Link juice consolidation** - visi backlinkai koncentruojasi į .lt
4. **Avoiding duplicate content** - canonical tagais išvengta dublikatų
5. **Geographic relevance** - .lt domenas geriau Lietuvos rinkai

### Būsimi veiksmai / Next Steps

1. **.htaccess įkelimas** į .com domeno serverį
2. **Google Search Console** - .com domeno puslapių perkėlimas
3. **Sitemaps pateikimas** - atnaujinti GSC
4. **301 redirects monitoringas** - patikrinti, ar veikia
5. **Analytics suvienijimas** - nukreipti .com traffic į .lt analytics

### Monitoring

- Stebėti 301 redirects Google Search Console
- Tikrinti crawl errors naujose konfigūracijose
- Monitorinti index status pokyčius
- Sekti domain authority konsolidaciją
