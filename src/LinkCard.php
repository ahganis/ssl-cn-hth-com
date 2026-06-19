<?php

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $domain;
    private array $metadata;

    public function __construct(
        string $url = 'https://ssl-cn-hth.com',
        string $title = 'hth 示例服务',
        string $description = '这是一个演示链接卡片的数据来源，用于展示安全转义后的 HTML 输出。',
        string $domain = 'ssl-cn-hth.com'
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = $domain;
        $this->metadata = [
            'favicon' => 'https://ssl-cn-hth.com/favicon.ico',
            'lang' => 'zh-CN',
            'keywords' => ['hth', 'demo', 'link'],
        ];
    }

    public function renderCard(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $safeDomain = htmlspecialchars($this->domain, ENT_QUOTES, 'UTF-8');
        $safeFavicon = htmlspecialchars($this->metadata['favicon'], ENT_QUOTES, 'UTF-8');

        $html = '<div class="link-card">' . "\n";
        $html .= '    <a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        <div class="card-image">' . "\n";
        $html .= '            <img src="' . $safeFavicon . '" alt="' . $safeTitle . ' icon" width="16" height="16">' . "\n";
        $html .= '        </div>' . "\n";
        $html .= '        <div class="card-body">' . "\n";
        $html .= '            <span class="card-domain">' . $safeDomain . '</span>' . "\n";
        $html .= '            <h3 class="card-title">' . $safeTitle . '</h3>' . "\n";
        $html .= '            <p class="card-description">' . $safeDesc . '</p>' . "\n";
        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>';

        return $html;
    }

    public function renderCardWithKeywords(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $safeDomain = htmlspecialchars($this->domain, ENT_QUOTES, 'UTF-8');
        $safeFavicon = htmlspecialchars($this->metadata['favicon'], ENT_QUOTES, 'UTF-8');

        $keywordItems = '';
        foreach ($this->metadata['keywords'] as $kw) {
            $safeKw = htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
            $keywordItems .= '<span class="keyword-badge">' . $safeKw . '</span> ';
        }

        $html = '<div class="link-card-enhanced">' . "\n";
        $html .= '    <div class="card-header">' . "\n";
        $html .= '        <img src="' . $safeFavicon . '" alt="favicon" class="card-favicon">' . "\n";
        $html .= '        <span class="card-domain">' . $safeDomain . '</span>' . "\n";
        $html .= '    </div>' . "\n";
        $html .= '    <div class="card-content">' . "\n";
        $html .= '        <a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '            <h2 class="card-title">' . $safeTitle . '</h2>' . "\n";
        $html .= '        </a>' . "\n";
        $html .= '        <p class="card-description">' . $safeDesc . '</p>' . "\n";
        $html .= '        <div class="card-keywords">' . $keywordItems . '</div>' . "\n";
        $html .= '    </div>' . "\n";
        $html .= '</div>';

        return $html;
    }

    public function setMetadata(array $data): void
    {
        if (isset($data['favicon'])) {
            $this->metadata['favicon'] = $data['favicon'];
        }
        if (isset($data['lang'])) {
            $this->metadata['lang'] = $data['lang'];
        }
        if (isset($data['keywords']) && is_array($data['keywords'])) {
            $this->metadata['keywords'] = $data['keywords'];
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public static function createDefault(): self
    {
        return new self(
            'https://ssl-cn-hth.com',
            'hth 演示卡片',
            '通过 hth 关键词展示安全的 HTML 转义输出。',
            'ssl-cn-hth.com'
        );
    }

    public static function createCustom(string $url, string $title, string $desc, string $domain): self
    {
        $instance = new self($url, $title, $desc, $domain);
        return $instance;
    }
}