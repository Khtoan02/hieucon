<script>
  // ── DỮ LIỆU CHECKLIST ──
  const GROUPS = [
    {
      id: 'tieuHoa',
      name: 'Rối loạn tiêu hóa',
      icon: '🫁',
      desc: 'Tình trạng đường ruột và các vấn đề về tiêu hóa hàng ngày',
      items: [
        { main: 'Trẻ thường xuyên xì hơi nặng mùi hoặc hơi thở hôi dù đã vệ sinh răng miệng?', example: 'Trẻ thường xuyên xì hơi nặng mùi hoặc có hơi thở hôi (dù đã vệ sinh răng miệng sạch sẽ)?' },
        { main: 'Trẻ hay đầy bụng, chướng bụng, sôi bụng hoặc ợ chua sau ăn?', example: 'Trẻ hay bị đầy bụng, chướng bụng, sôi bụng hoặc ợ chua thường xuyên sau khi ăn?' },
        { main: 'Trẻ đi ngoài không đều, phân lỏng, sống, có bọt hoặc mùi bất thường?', example: 'Trẻ đi ngoài (tiêu) không đều, tính chất phân bất thường (phân sống, lỏng, có bọt hoặc mùi chua/khai nồng)?' },
        { main: 'Trẻ táo bón kéo dài, đau khi đi vệ sinh, són phân hoặc né tránh đi vệ sinh?', example: 'Trẻ bị táo bón kéo dài (nhiều ngày mới đi một lần) kèm theo biểu hiện đau đớn, són phân ra quần hoặc sợ hãi, lảng tránh việc đi vệ sinh?' },
        { main: 'Trẻ có dấu hiệu đau bụng dữ dội như ôm bụng, cong người, khóc nhiều hoặc đập bụng vào vật cứng?', example: 'Trẻ có biểu hiện đau bụng cấp tính như ôm bụng, cong người quấy khóc dữ dội, hoặc đập bụng vào các vật cứng (cạnh bàn, ghế) để tự giảm đau?' }
      ]
    },
    {
      id: 'anUong',
      name: 'Rối loạn ăn uống',
      icon: '🍽️',
      desc: 'Các hành vi kén ăn, nhạy cảm thực phẩm và khó khăn trong bữa ăn',
      items: [
        { main: 'Trẻ chỉ chấp nhận một số rất ít món ăn quen thuộc?', example: 'Trẻ có xu hướng kén ăn, chỉ chấp nhận một danh mục thực phẩm rất hạn hẹp (ví dụ: chỉ ăn đồ chiên, chỉ ăn cơm trắng)?' },
        { main: 'Trẻ rất nhạy với mùi, màu, vị hoặc kết cấu thức ăn?', example: 'Trẻ cực kỳ nhạy cảm với kết cấu (mềm, nhão, giòn), màu sắc hoặc mùi vị của thức ăn, dễ dàng phát hiện ra sự thay đổi nhỏ trong món ăn?' },
        { main: 'Trẻ hay ngậm lâu, không nhai nuốt, buồn nôn hoặc oẹ khi gặp món lạ?', example: 'Trẻ thường xuyên ngậm thức ăn rất lâu trong miệng không chịu nhai nuốt, hoặc có hành vi nôn trớ, oẹ khi ngửi/thấy thức ăn lạ?' },
        { main: 'Chế độ ăn hạn hẹp khiến trẻ chậm tăng cân, sụt cân, mệt mỏi hoặc có dấu hiệu thiếu chất?', example: 'Chế độ ăn quá hạn hẹp (dưới 10 món) khiến trẻ có dấu hiệu thiếu chất (da xanh xao, móng tay có vệt trắng, hay mệt mỏi) hoặc sụt cân/chậm tăng cân?' },
        { main: 'Trẻ ăn/nhai vật không phải thức ăn hoặc bùng nổ dữ dội khi bị ép ăn?', example: 'Trẻ có hành vi ăn, nhai các vật không phải thực phẩm (như giấy, đất, cát, đồ nhựa - hội chứng Pica) hoặc bùng nổ dữ dội nếu bị ép ăn món không thích?' }
      ]
    },
    {
      id: 'giacNgu',
      name: 'Rối loạn giấc ngủ',
      icon: '🌙',
      desc: 'Tình trạng giấc ngủ và nhịp sinh học của trẻ',
      items: [
        { main: 'Trẻ thường mất hơn 60 phút mới ngủ được?', example: 'Trẻ thường xuyên mất hơn 60 phút trằn trọc mới có thể đi vào giấc ngủ?' },
        { main: 'Trẻ phải có điều kiện đặc biệt mới ngủ, như ôm chặt, tiếng ồn trắng hoặc bật đèn?', example: 'Trẻ lệ thuộc hoàn toàn vào các hỗ trợ giác quan hoặc quy trình cứng nhắc để ngủ (phải ôm chặt, phải có tiếng ồn trắng, hoặc phải bật đèn)?' },
        { main: 'Trẻ thức giấc nhiều lần trong đêm và khó ngủ lại?', example: 'Trẻ hay thức giấc giữa đêm (từ 2 lần trở lên) và mất rất nhiều thời gian để dỗ ngủ lại?' },
        { main: 'Khi ngủ, trẻ nghiến răng, đổ mồ hôi nhiều hoặc cử động chân tay liên tục?', example: 'Khi ngủ, trẻ có các biểu hiện thực thể như nghiến răng ken két, đổ mồ hôi trộm đầm đìa hoặc chân tay cử động không ngừng?' },
        { main: 'Trẻ thường la hét hoảng loạn ban đêm hoặc thức trắng nhiều giờ giữa đêm?', example: 'Trẻ thường xuyên gặp cơn hoảng sợ ban đêm (la hét hoảng loạn khi đang ngủ) hoặc thức trắng nhiều giờ liền giữa đêm trong trạng thái tỉnh táo?' }
      ]
    },
    {
      id: 'camGiac',
      name: 'Xử lý giác quan',
      icon: '🎯',
      desc: 'Cách trẻ tiếp nhận và phản ứng với các kích thích từ môi trường',
      items: [
        { main: 'Trẻ sợ tiếng ồn, ánh sáng hoặc khó chịu với một số chất liệu quần áo?', example: 'Trẻ có biểu hiện quá nhạy cảm với các kích thích môi trường như: sợ tiếng ồn bình thường, khó chịu với ánh sáng đèn, hay từ chối mặc quần áo có chất liệu nhất định?' },
        { main: 'Trẻ thích va chạm mạnh, nhìn vật xoay, ngửi đồ vật hoặc tìm cảm giác mạnh?', example: 'Trẻ có xu hướng tìm kiếm cảm giác mạnh như: thích va chạm mạnh vào người khác, nhìn chằm chằm vào vật xoay tròn, hoặc thích ngửi đồ vật/người lạ?' },
        { main: 'Trẻ vụng về, hay vấp ngã, nhảy liên tục hoặc khó điều chỉnh lực tay?', example: 'Trẻ gặp khó khăn về thăng bằng và nhận thức cơ thể: thường xuyên vấp ngã, vụng về, nhảy lên xuống liên tục hoặc không biết điều chỉnh lực tay (quá mạnh hoặc quá nhẹ)?' },
        { main: 'Trẻ khó nhận biết đói, đau, buồn vệ sinh hoặc tín hiệu bên trong cơ thể?', example: 'Trẻ dường như không nhận biết được các tín hiệu nội tại của cơ thể: không cảm thấy đói, đau khi bị thương, hoặc gặp khó khăn lớn trong việc tập đi vệ sinh đúng lúc?' },
        { main: 'Trẻ dễ bùng nổ hoặc đóng băng khi ở nơi quá đông, ồn hoặc nhiều kích thích?', example: 'Trẻ thường xuyên có các cơn bùng nổ (la hét, mất kiểm soát) hoặc đóng băng (im lặng, ngắt kết nối hoàn toàn) khi phải ở nơi có quá nhiều kích thích?' }
      ]
    },
    {
      id: 'tangDong',
      name: 'Tăng động - Giảm chú ý',
      icon: '⚡',
      desc: 'Mức độ hoạt động, khả năng tập trung và tự kiểm soát của trẻ',
      items: [
        { main: 'Trẻ thường không phản hồi khi được gọi hoặc khó theo hướng dẫn?', example: 'Trẻ dường như không nghe thấy khi được gọi tên hoặc không để ý đến hướng dẫn của người lớn vì đang bị thu hút quá mức bởi một chi tiết nhỏ?' },
        { main: 'Trẻ rất khó chuyển hoạt động, dễ khựng lại hoặc bùng nổ khi bị yêu cầu dừng việc đang thích?', example: 'Trẻ có thể cực kỳ tập trung vào thứ mình thích nhưng lại "khựng lại" hoặc bùng nổ khi được yêu cầu chuyển sang một hoạt động khác (như đi tắm, đi ăn)?' },
        { main: 'Trẻ luôn bồn chồn, di chuyển, nhún nhảy hoặc táy máy tay chân?', example: 'Trẻ có biểu hiện bồn chồn, luôn phải di chuyển, nhún nhảy hoặc táy máy tay chân ngay cả khi cơ thể đã mệt mỏi hoặc trong môi trường cần sự yên tĩnh?' },
        { main: 'Trẻ hay lao đi, leo trèo, nhảy từ cao hoặc làm việc nguy hiểm mà chưa kịp cân nhắc?', example: 'Trẻ thường lao đi hoặc thực hiện các hành động nguy hiểm (nhảy từ trên cao, lao ra đường) mà dường như không có sự cân nhắc hay nhận thức được hậu quả ngay lúc đó?' },
        { main: 'Sau khi cố ngồi yên hoặc tập trung, trẻ cáu kỉnh, kiệt sức hoặc ngắt kết nối rõ rệt?', example: 'Sau một khoảng thời gian ngắn cố gắng tập trung hoặc ngồi yên, trẻ có biểu hiện cáu kỉnh dữ dội, mệt mỏi hoặc "ngắt kết nối" hoàn toàn?' }
      ]
    },
    {
      id: 'camXuc',
      name: 'Cảm xúc - Hành vi',
      icon: '🤝',
      desc: 'Khả năng điều tiết cảm xúc, lo âu và các phản ứng khi khủng hoảng',
      items: [
        { main: 'Trẻ có thay đổi cảm xúc thất thường mà không rõ nguyên nhân?', example: 'Trẻ có những cơn vui buồn thất thường mà không có lý do ngoại cảnh rõ ràng (ví dụ: đang chơi bình thường bỗng khóc thét hoặc cười ngặt nghẽo)?' },
        { main: 'Trẻ rất căng thẳng hoặc bùng nổ khi lịch trình thay đổi?', example: 'Trẻ cực kỳ căng thẳng, lo âu hoặc bùng nổ nếu lịch trình sinh hoạt bị thay đổi nhỏ, hoặc gặp khó khăn lớn khi phải dừng việc đang làm để chuyển sang việc khác?' },
        { main: 'Hành vi lặp lại tăng mạnh khi trẻ lo lắng hoặc áp lực?', example: 'Trẻ thực hiện các hành vi lặp đi lặp lại (như vẫy tay, xoay đồ vật, lặp lại lời nói) với cường độ cao hơn hẳn mỗi khi gặp áp lực hoặc lo lắng?' },
        { main: 'Trẻ thường la hét, khóc kéo dài và rất khó dỗ?', example: 'Trẻ thường xuyên có những cơn la hét, khóc lóc dữ dội kéo dài (trên 15-30 phút) mà mọi nỗ lực dỗ dành hay đe dọa của người lớn đều không có tác dụng?' },
        { main: 'Khi khủng hoảng, trẻ tự làm đau hoặc tấn công người khác?', example: 'Khi gặp khủng hoảng, trẻ có hành vi tự làm đau (đập đầu, cắn tay mình) hoặc tấn công người khác (cắn, cào cấu, ném đồ vật)?' }
      ]
    },
    {
      id: 'mienDich',
      name: 'Miễn dịch - Dị ứng',
      icon: '🛡️',
      desc: 'Tình trạng đề kháng, phản ứng viêm và các nhạy cảm thể chất',
      items: [
        { main: 'Trẻ hay hắt hơi, sổ mũi, dụi mắt/mũi, mẩn đỏ hoặc ngứa da?', example: 'Trẻ thường xuyên có các biểu hiện dị ứng như: hay hắt hơi, sổ mũi khi thời tiết thay đổi, dụi mắt/mũi liên tục, hoặc da dễ bị mẩn đỏ, ngứa ngáy, viêm da cơ địa?' },
        { main: 'Trẻ có biểu hiện lạ sau khi ăn một số thực phẩm hoặc tiếp xúc mùi hóa chất?', example: 'Trẻ có biểu hiện lạ sau khi ăn thực phẩm nhất định (sữa, bột mì, đồ ngọt) hoặc ngửi mùi hóa chất như: đỏ tai, đỏ má, quầng thâm mắt đậm lên hoặc đột ngột kích động?' },
        { main: 'Trẻ hay bị viêm tai, viêm họng, viêm amidan hoặc sưng nướu lặp lại?', example: 'Trẻ thường xuyên bị các đợt viêm nhiễm lặp đi lặp lại như: viêm tai giữa, viêm họng, viêm amidan hoặc sưng nướu răng mãn tính?' },
        { main: 'Trẻ dễ ốm, lâu khỏi và sau ốm thường mệt mỏi kéo dài?', example: 'Trẻ rất dễ bị lây bệnh từ người khác (đề kháng kém), mỗi đợt ốm thường kéo dài lâu khỏi hơn bình thường và sau khi khỏi, trẻ vẫn bị sụt giảm năng lượng, mệt mỏi kéo dài?' },
        { main: 'Sau các đợt ốm hoặc dị ứng nặng, trẻ lờ đờ, mất tập trung rõ hoặc giảm kỹ năng đã có?', example: 'Trẻ dường như rơi vào trạng thái "sương mù não" (lờ đờ, mất tập trung hoàn toàn) hoặc đột ngột mất đi các kỹ năng đã thạo (như ngôn ngữ, vệ sinh) mỗi khi hệ miễn dịch bị kích hoạt mạnh do ốm hoặc dị ứng nặng?' }
      ]
    },
    {
      id: 'vanDong',
      name: 'Chức năng vận động',
      icon: '🏃',
      desc: 'Phối hợp vận động thô/tinh và các hoạt động tự phục vụ của trẻ',
      items: [
        { main: 'Trẻ khó cài cúc, kéo khóa, cầm thìa, dùng kéo hoặc bút chì?', example: 'Trẻ gặp khó khăn với các nhiệm vụ cần sự khéo léo của bàn tay như: cài cúc áo, kéo khóa, cầm thìa đúng cách, hoặc sử dụng kéo và bút chì?' },
        { main: 'Trẻ hay vấp ngã, va vào đồ vật hoặc đi đứng thiếu vững vàng?', example: 'Trẻ thường xuyên vấp ngã, va vào đồ vật/người khác khi đi lại, hoặc có tư thế đi đứng trông không vững vàng, thiếu sự nhịp nhàng?' },
        { main: 'Trẻ nhanh mệt, cơ thể mềm yếu, hay tựa người, nằm bò ra bàn hoặc ngồi chữ W?', example: 'Cơ thể trẻ có vẻ "mềm yếu", trẻ nhanh mệt khi phải đi bộ, thường có xu hướng tựa vào người khác, nằm bò ra bàn hoặc ngồi tư thế chữ W để giữ thăng bằng?' },
        { main: 'Trẻ khó học chuỗi vận động mới như nhảy theo nhạc, đạp xe, leo cầu thang?', example: 'Trẻ gặp khó khăn lớn khi học các chuỗi vận động mới (như tập nhảy theo điệu nhạc, đạp xe, hoặc leo trèo cầu thang luân phiên chân)?' },
        { main: 'Trẻ rất khó thực hiện chuỗi tự phục vụ như ăn uống, mặc quần áo, vệ sinh cá nhân?', example: 'Trẻ gặp khó khăn cực lớn trong việc thực hiện các chuỗi hành động tự phục vụ cơ bản (như cầm bát ăn, tự mặc quần áo, vệ sinh cá nhân) hoặc có các kiểu vận động rất cứng nhắc, vụng về.' }
      ]
    }
  ];

  // ==========================================
  // ── CORE APPLICATION CONTROLLER (ChecklistApp) ──
  // ==========================================
  const ChecklistApp = {
    state: {
      userCode: '',
      startTime: null,
      answers: {},
      completedGroups: new Set(),
      currentGroup: 0,
      currentGroupStartTime: Date.now(),
      currentGroupFirstClickRecorded: false,
      deepTracker: {
        activeTime: 0,
        toggles: {},
        thinkTimes: {},
        deletedChars: 0,
        highlighted: new Set(),
        location: 'Đang lấy...',
        ip: '',
        utms: {},
        drop_point: 'Chưa bắt đầu',
        lastFocus: Date.now()
      }
    },

    init() {
      this.state.startTime = Date.now();
      this.initUTM();
      this.initDeepTracking();

      // Khởi trị các module con
      ModuleChildInfo.init(this);
      ModuleSurvey.init(this);
      ModuleParentInfo.init(this);
      ModuleSuccess.init(this);
    },

    initUTM() {
      const params = new URLSearchParams(window.location.search);
      for (const [key, value] of params.entries()) {
        if (key.startsWith('utm_')) {
          this.state.deepTracker.utms[key] = value;
        }
      }
    },

    initDeepTracking() {
      // Lấy IP & Vị trí
      fetch('https://api.db-ip.com/v2/free/self')
        .then(res => res.json())
        .then(data => {
          this.state.deepTracker.location = data.city + ', ' + data.countryName;
          this.state.deepTracker.ip = data.ipAddress;
        }).catch(e => {
          this.state.deepTracker.location = 'Không xác định';
        });

      // Active Time
      window.addEventListener('blur', () => {
        this.state.deepTracker.activeTime += (Date.now() - this.state.deepTracker.lastFocus);
      });
      window.addEventListener('focus', () => {
        this.state.deepTracker.lastFocus = Date.now();
      });
      window.addEventListener('visibilitychange', () => {
        if (document.hidden) {
          this.state.deepTracker.activeTime += (Date.now() - this.state.deepTracker.lastFocus);
        } else {
          this.state.deepTracker.lastFocus = Date.now();
        }
      });

      // Text selection
      document.addEventListener('mouseup', () => {
        const selection = window.getSelection().toString().trim();
        if (selection.length > 3 && selection.length < 50) {
          this.state.deepTracker.highlighted.add(selection);
        }
      });

      // Input deletions
      document.addEventListener('keydown', (e) => {
        if ((e.key === 'Backspace' || e.key === 'Delete') && e.target.tagName === 'TEXTAREA') {
          this.state.deepTracker.deletedChars++;
        }
      });
    },

    pingServerDropOff() {
      if (!this.state.userCode) return;
      this.state.deepTracker.activeTime += (Date.now() - this.state.deepTracker.lastFocus);
      this.state.deepTracker.lastFocus = Date.now();

      const timeSpent = Math.floor((Date.now() - this.state.startTime) / 1000);
      const da = {
        ...this.state.deepTracker,
        highlighted: Array.from(this.state.deepTracker.highlighted),
        activeTime: Math.floor(this.state.deepTracker.activeTime / 1000)
      };

      const formData = new FormData();
      formData.append('action', 'hieucon_dh_submit_checklist');
      formData.append('user_code', this.state.userCode);
      formData.append('child_name', ModuleChildInfo.getChildName());
      formData.append('child_age', ModuleChildInfo.getChildAge());
      formData.append('child_gender', ModuleChildInfo.getChildGender());
      formData.append('child_height', ModuleChildInfo.getChildHeight());
      formData.append('child_weight', ModuleChildInfo.getChildWeight());
      formData.append('child_diagnosis', ModuleChildInfo.getChildDiagnosis());
      formData.append('child_therapy', ModuleChildInfo.getChildTherapy());
      formData.append('child_supplement', ModuleChildInfo.getChildSupplement());
      formData.append('parent_concern', ModuleChildInfo.getParentConcern());

      // Bổ sung thông tin phụ huynh nếu có
      formData.append('parent_name', ModuleParentInfo.getParentName());
      formData.append('parent_phone', ModuleParentInfo.getParentPhone());
      formData.append('parent_email', ModuleParentInfo.getParentEmail());

      const extraSymptomsEl = document.getElementById('extra-symptoms');
      formData.append('extra_symptoms', extraSymptomsEl ? extraSymptomsEl.value.trim() : '');

      // Bổ sung scores nếu đã hoàn thành trắc nghiệm
      if (Object.keys(this.state.answers).length > 0) {
        const scores = ModuleSurvey.calculateScores();
        const behaviorsByGroup = {};
        scores.forEach(s => {
          if (s.tickedItems && s.tickedItems.length > 0) {
            behaviorsByGroup[s.id] = s.tickedItems;
          }
        });
        formData.append('scores_json', JSON.stringify(scores));
        formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
      }

      formData.append('time_spent', timeSpent);
      formData.append('device_info', navigator.userAgent);
      formData.append('deep_analytics', JSON.stringify(da));

      fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData }).catch(() => { });
    }
  };

  // ==========================================
  // ── MODULE 1: THÔNG TIN TRẺ (ModuleChildInfo) ──
  // ==========================================
  const ModuleChildInfo = {
    app: null,

    init(appInstance) {
      this.app = appInstance;
      this.bindEvents();
    },

    bindEvents() {
      const dayEl = document.getElementById('child-dob-day');
      const monthEl = document.getElementById('child-dob-month');
      const yearEl = document.getElementById('child-dob-year');

      if (dayEl && monthEl && yearEl) {
        dayEl.addEventListener('input', () => this.calculateAge());
        monthEl.addEventListener('input', () => this.calculateAge());
        yearEl.addEventListener('input', () => this.calculateAge());
      }
    },

    getChildName() { return document.getElementById('child-name') ? document.getElementById('child-name').value.trim() : ''; },
    getChildAge() { return document.getElementById('child-age') ? document.getElementById('child-age').value : ''; },
    getChildGender() {
      const genderEl = document.querySelector('input[name="child-gender"]:checked');
      return genderEl ? genderEl.value : '';
    },
    getChildHeight() { return document.getElementById('child-height') ? document.getElementById('child-height').value.trim() : ''; },
    getChildWeight() { return document.getElementById('child-weight') ? document.getElementById('child-weight').value.trim() : ''; },
    getChildDiagnosis() { return document.getElementById('child-diagnosis') ? document.getElementById('child-diagnosis').value : ''; },
    getChildTherapy() { return document.getElementById('child-therapy') ? document.getElementById('child-therapy').value.trim() : ''; },
    getChildSupplement() { return document.getElementById('child-supplement') ? document.getElementById('child-supplement').value.trim() : ''; },
    getParentConcern() { return document.getElementById('parent-concern') ? document.getElementById('parent-concern').value.trim() : ''; },

    calculateAge() {
      const d = document.getElementById('child-dob-day').value;
      const m = document.getElementById('child-dob-month').value;
      const y = document.getElementById('child-dob-year').value;
      const displayDiv = document.getElementById('calculated-age');
      const hiddenInput = document.getElementById('child-age');

      if (!d || !m || !y) {
        displayDiv.innerText = '';
        hiddenInput.value = '';
        return;
      }

      const dob = new Date(y, m - 1, d);
      const today = new Date();

      if (dob.getFullYear() != y || dob.getMonth() != m - 1 || dob.getDate() != d) {
        displayDiv.innerText = 'Ngày sinh không tồn tại';
        displayDiv.style.color = '#e11d48';
        hiddenInput.value = '';
        return;
      }

      let months = (today.getFullYear() - dob.getFullYear()) * 12;
      months -= dob.getMonth();
      months += today.getMonth();

      if (today.getDate() < dob.getDate()) {
        months--;
      }

      if (months < 0) {
        displayDiv.innerText = 'Ngày sinh chưa hợp lệ';
        displayDiv.style.color = '#e11d48';
        hiddenInput.value = '';
        return;
      }

      let ageStr = '';
      if (months < 24) {
        ageStr = months + ' tháng tuổi';
      } else {
        const years = Math.floor(months / 12);
        const extraMonths = months % 12;
        ageStr = years + ' tuổi ' + (extraMonths > 0 ? extraMonths + ' tháng' : '');
      }

      displayDiv.innerText = 'Tuổi của con: ' + ageStr;
      displayDiv.style.color = 'var(--navy)';
      hiddenInput.value = ageStr;
    },

    validate() {
      const childName = this.getChildName();
      const age = this.getChildAge();
      const gender = this.getChildGender();
      const height = this.getChildHeight();
      const weight = this.getChildWeight();
      const diagnosis = this.getChildDiagnosis();

      if (!childName || !age || !gender || !height || !weight || !diagnosis) {
        alert('Ba mẹ vui lòng điền đầy đủ các thông tin có dấu * trước khi tiếp tục.');
        return false;
      }
      return true;
    },

    submit() {
      if (!this.validate()) return;

      // Sinh mã hồ sơ (userCode) 8 chữ số nếu chưa có
      if (!this.app.state.userCode) {
        this.app.state.userCode = Math.floor(10000000 + Math.random() * 90000000).toString();
      }

      // Đổi trạng thái nút bấm
      const btn = document.querySelector('#info-section .btn-primary');
      if (btn) {
        btn.disabled = true;
        btn.innerText = 'ĐANG KHỞI TẠO HỒ SƠ...';
      }

      // Tạo bản ghi Draft đầu tiên ngay lập tức
      const timeSpent = Math.floor((Date.now() - this.app.state.startTime) / 1000);
      const da = {
        ...this.app.state.deepTracker,
        highlighted: Array.from(this.app.state.deepTracker.highlighted),
        activeTime: Math.floor(this.app.state.deepTracker.activeTime / 1000)
      };

      const formData = new FormData();
      formData.append('action', 'hieucon_dh_submit_checklist');
      formData.append('user_code', this.app.state.userCode);
      formData.append('child_name', this.getChildName());
      formData.append('child_age', this.getChildAge());
      formData.append('child_gender', this.getChildGender());
      formData.append('child_height', this.getChildHeight());
      formData.append('child_weight', this.getChildWeight());
      formData.append('child_diagnosis', this.getChildDiagnosis());
      formData.append('child_therapy', this.getChildTherapy());
      formData.append('child_supplement', this.getChildSupplement());
      formData.append('parent_concern', this.getParentConcern());
      formData.append('time_spent', timeSpent);
      formData.append('device_info', navigator.userAgent);
      formData.append('deep_analytics', JSON.stringify(da));

      fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(res => {
          console.log('Draft record initialized:', res);
          this.transitionToNextStep();
        })
        .catch(err => {
          console.error('Error creating draft:', err);
          // Vẫn cho phép tiếp tục dù gặp lỗi kết nối phụ
          this.transitionToNextStep();
        });
    },

    transitionToNextStep() {
      // Hide first container (Child Info step)
      const childInfoContainer = document.getElementById('survey-page-container');
      if (childInfoContainer) childInfoContainer.style.display = 'none';

      // Hide Hero Section if visible
      const hero = document.getElementById('hero-section');
      if (hero) hero.style.display = 'none';

      // Show second container (Survey step)
      const surveyContainer = document.getElementById('survey-active-container');
      if (surveyContainer) surveyContainer.style.display = 'grid';

      // Initialize the Radar Chart!
      initializeRadarChart();

      // Hiển thị thanh tiến trình và kích hoạt ModuleSurvey
      document.getElementById('progress-wrap').style.display = 'none';
      ModuleSurvey.start();
    }
  };

  // ==========================================
  // ── MODULE 2: TRẮC NGHIỆM HÀNH VI (ModuleSurvey) ──
  // ==========================================
  const ModuleSurvey = {
    app: null,

    init(appInstance) {
      this.app = appInstance;
    },

    start() {
      this.buildChecklist();
      this.buildProgressSteps();
      this.showGroup(0);

      if (typeof fbq !== 'undefined') {
        fbq('track', 'ViewContent', { content_name: 'Start DH Checklist', content_category: 'Checklist' });
      }

      this.app.state.deepTracker.drop_point = `Nhóm 1 / ${GROUPS.length}: ${GROUPS[0].name}`;
      this.app.pingServerDropOff();

      // Show mobile Radar FAB!
      const fab = document.getElementById('mobile-radar-fab');
      if (fab) fab.style.display = 'flex';
    },

    buildProgressSteps() {
      const wrap = document.getElementById('progress-steps');
      if (!wrap) return;
      wrap.innerHTML = GROUPS.map((g, i) =>
        `<span class="progress-step" id="pstep-${i}" onclick="ModuleSurvey.jumpToGroup(${i})">${g.icon} ${g.name}</span>`
      ).join('');
    },

    buildChecklist() {
      const container = document.getElementById('checklist-container');
      if (!container) return;
      container.innerHTML = '';
      GROUPS.forEach((group, gi) => {
        if (!this.app.state.answers[group.id]) {
          this.app.state.answers[group.id] = Array(group.items.length).fill(false);
        }

        const sec = document.createElement('div');
        sec.className = 'checklist-section';
        sec.id = `group-${gi}`;
        
        let itemsHtml = '';
        group.items.forEach((item, ii) => {
          const isChecked = this.app.state.answers[group.id][ii];
          itemsHtml += `
            <label class="check-item-row flex items-start gap-4 p-4 border border-solid border-[#e2e8f0] rounded-xl bg-[#faf9f6] hover:border-navy/40 transition-colors cursor-pointer ${isChecked ? 'checked' : ''}" id="ci-row-${gi}-${ii}">
              <div class="checkbox-wrapper shrink-0 mt-0.5">
                <input type="checkbox" id="opt-yes-${gi}-${ii}" onchange="ModuleSurvey.toggleItemCheckbox(${gi},${ii},this)" class="custom-survey-checkbox" ${isChecked ? 'checked' : ''}>
                <div class="custom-checkbox-box">
                  <svg class="checkmark-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                  </svg>
                </div>
              </div>
              <div class="check-text flex-1 text-left">
                <div class="check-main" style="line-height: 1.5; font-weight: 500; font-size: 14px; color: var(--charcoal); position: relative; display: inline-block;">
                  <span>${item.main}</span>
                  <span class="info-tooltip-wrapper inline-flex items-center ml-1.5" onclick="toggleTooltip(this, event)">
                    <span class="info-tooltip-trigger" style="margin: 0 0 0 4px; width: 15px; height: 15px; font-size: 9px; line-height: 15px;">i</span>
                    <span class="info-tooltip-content">Ví dụ: ${item.example}<span style="display:block; text-align:right; font-size:10px; opacity:0.7; margin-top:6px; font-weight:normal;">✕ Chạm để đóng</span></span>
                  </span>
                </div>
              </div>
            </label>
          `;
        });

        sec.innerHTML = `
            <div class="section-header" style="display:flex; align-items:center; justify-content:space-between; width:100%; gap: 16px; margin-bottom: 20px; user-select:none;">
              <div style="display:flex; align-items:center; gap: 12px;">
                <div class="section-icon">${group.icon}</div>
                <div>
                  <div class="section-title">${group.name}</div>
                  <div class="section-subtitle">${group.desc}</div>
                </div>
              </div>
            </div>
            <div class="group-score" style="display: none;">
              <span class="group-score-label">Điểm số:</span>
              <span class="group-score-value" id="gscore-${gi}">0 / 15 điểm</span>
              <div class="group-score-bar"><div class="group-score-fill" id="gbar-${gi}"></div></div>
            </div>
            <div class="checklist-items flex flex-col gap-3">
              ${itemsHtml}
            </div>
            
            <!-- Slide Navigation Buttons -->
            <div class="slide-navigation">
              ${gi > 0 ? `<button type="button" class="btn-prev-slide" onclick="ModuleSurvey.prevGroup(${gi})">← Quay lại</button>` : `<div></div>`}
              ${gi < 7 ? `<button type="button" class="btn-next-slide" onclick="ModuleSurvey.nextGroup(${gi})">Tiếp theo →</button>` : `<div></div>`}
            </div>
          `;
        container.appendChild(sec);
      });
    },

    toggleItemCheckbox(gi, ii, cb) {
      const isChecked = cb.checked;
      const row = document.getElementById(`ci-row-${gi}-${ii}`);
      
      if (isChecked) {
        if (row) row.classList.add('checked');
        this.app.state.answers[GROUPS[gi].id][ii] = true;
      } else {
        if (row) row.classList.remove('checked');
        this.app.state.answers[GROUPS[gi].id][ii] = false;
      }

      const groupName = GROUPS[gi].name;
      const itemName = GROUPS[gi].items[ii].main;

      if (!this.app.state.currentGroupFirstClickRecorded) {
        const thinkSeconds = Math.floor((Date.now() - this.app.state.currentGroupStartTime) / 1000);
        this.app.state.deepTracker.thinkTimes[groupName] = thinkSeconds;
        this.app.state.currentGroupFirstClickRecorded = true;
      }

      const itemKey = groupName + ' - ' + itemName;
      this.app.state.deepTracker.toggles[itemKey] = (this.app.state.deepTracker.toggles[itemKey] || 0) + 1;

      this.updateGroupScore(gi);
      this.checkGroupCompletion(gi);
    },

    updateGroupScore(gi) {
      const group = GROUPS[gi];
      let score = 0;
      this.app.state.answers[group.id].forEach((ticked, index) => {
        if (ticked) {
          score += (index + 1);
        }
      });
      document.getElementById(`gscore-${gi}`).textContent = `${score} / 15 điểm`;
      document.getElementById(`gbar-${gi}`).style.width = `${(score / 15) * 100}%`;

      // Cập nhật biểu đồ Radar bên cột phải
      updateRadarChartData();
    },

    showGroup(gi) {
      if (this.app.state.currentGroup !== undefined) {
        const prev = document.getElementById(`group-${this.app.state.currentGroup}`);
        if (prev) {
          prev.classList.remove('active');
          this.app.state.completedGroups.add(this.app.state.currentGroup);
        }
      }
      this.app.state.currentGroup = gi;
      this.app.state.currentGroupStartTime = Date.now();
      this.app.state.currentGroupFirstClickRecorded = false;
      document.querySelectorAll('.checklist-section').forEach(s => s.classList.remove('active'));

      const targetGroup = document.getElementById(`group-${gi}`);
      if (targetGroup) {
        targetGroup.classList.add('active');
      }

      // Show/Hide completion section on the last group (index 7)
      const completionSec = document.getElementById('survey-completion-section');
      if (completionSec) {
        completionSec.style.display = (gi === GROUPS.length - 1) ? 'block' : 'none';
      }

      if (gi > 0 && gi < GROUPS.length) {
        this.app.state.deepTracker.drop_point = `Nhóm ${gi + 1} / ${GROUPS.length}: ${GROUPS[gi].name}`;
        this.app.pingServerDropOff();
      }

      this.updateProgress();
      
      // Scroll to the top of the survey column so the user doesn't stay scrolled down
      const activeSurvey = document.getElementById('survey-active-container');
      if (activeSurvey) {
        window.scrollTo({ top: activeSurvey.offsetTop - 20, behavior: 'smooth' });
      }
    },

    nextGroup(gi) {
      this.showGroup(gi + 1);
    },

    prevGroup(gi) {
      this.showGroup(gi - 1);
    },

    jumpToGroup(gi) {
      const el = document.getElementById(`group-${gi}`);
      if (el) {
        window.scrollTo({ top: el.offsetTop - 80, behavior: 'smooth' });
      }
    },

    isGroupCompleted(gi) {
      return true;
    },

    checkGroupCompletion(gi) {
      const section = document.getElementById(`group-${gi}`);
      if (!section) return;

      const isCompleted = this.isGroupCompleted(gi);
      if (isCompleted) {
        this.app.state.completedGroups.add(gi);
      } else {
        this.app.state.completedGroups.delete(gi);
      }
      this.updateProgress();
    },

    expandGroup(gi, event) {
      if (event) {
        event.stopPropagation();
        event.preventDefault();
      }
      const section = document.getElementById(`group-${gi}`);
      if (section) {
        section.classList.remove('completed-group');
      }
    },

    toggleGroupCollapse(gi) {
      const section = document.getElementById(`group-${gi}`);
      if (!section) return;

      if (section.classList.contains('completed-group')) {
        section.classList.remove('completed-group');
      } else {
        const isCompleted = this.isGroupCompleted(gi);
        if (isCompleted) {
          section.classList.add('completed-group');
        }
      }
    },

    updateProgress() {
      const done = this.app.state.completedGroups.size;
      const total = GROUPS.length;
      const fillEl = document.getElementById('progress-fill');
      const countEl = document.getElementById('progress-count');

      if (fillEl) fillEl.style.width = `${(done / total) * 100}%`;
      if (countEl) countEl.textContent = `${done} / ${total} nhóm`;

      GROUPS.forEach((_, i) => {
        const el = document.getElementById(`pstep-${i}`);
        if (el) {
          el.classList.remove('active', 'done');
          if (i === this.app.state.currentGroup) el.classList.add('active');
          else if (this.app.state.completedGroups.has(i)) el.classList.add('done');
        }
      });
    },

    calculateScores() {
      return GROUPS.map(g => {
        let score = 0;
        this.app.state.answers[g.id].forEach((ticked, index) => {
          if (ticked) {
            score += (index + 1);
          }
        });
        const ticked = score;
        const total = 15;
        const pct = Math.round((ticked / total) * 100);
        const tickedItems = g.items.filter((_, i) => this.app.state.answers[g.id][i]).map(x => x.main);
        return { id: g.id, name: g.name, icon: g.icon, ticked, total, pct, tickedItems };
      }).sort((a, b) => b.pct - a.pct);
    },

    completeSurvey() {
      // Recalculate and update Radar Chart to ensure it has all values!
      if (window.myRadarChart) {
        const newData = GROUPS.map(group => {
          const answers = this.app.state.answers[group.id];
          if (!answers) return 0;
          let score = 0;
          answers.forEach((ticked, index) => {
            if (ticked) score += (index + 1);
          });
          return Math.round((score / 15) * 100);
        });
        window.myRadarChart.data.datasets[0].data = newData;
        window.myRadarChart.update();
      }

      this.app.state.completedGroups.add(this.app.state.currentGroup);

      // Ẩn phần trắc nghiệm
      document.getElementById('checklist-container').style.display = 'none';
      document.getElementById('progress-wrap').style.display = 'none';
      const mobileInstr = document.getElementById('mobile-instructions-widget');
      if (mobileInstr) mobileInstr.style.display = 'none';

      const completionSec = document.getElementById('survey-completion-section');
      if (completionSec) completionSec.style.display = 'none';

      // Chuyển tiếp điều khiển sang ModuleParentInfo
      ModuleParentInfo.show();
    }
  };

  // ==========================================
  // ── MODULE 3: THÔNG TIN PHỤ HUYNH (ModuleParentInfo) ──
  // ==========================================
  const ModuleParentInfo = {
    app: null,

    init(appInstance) {
      this.app = appInstance;
    },

    getParentName() { return document.getElementById('parent-name') ? document.getElementById('parent-name').value.trim() : ''; },
    getParentPhone() { return document.getElementById('parent-phone') ? document.getElementById('parent-phone').value.trim() : ''; },
    getParentEmail() { return document.getElementById('parent-email') ? document.getElementById('parent-email').value.trim() : ''; },

    show() {
      const parentSec = document.getElementById('parent-info-section');
      if (parentSec) {
        parentSec.style.display = 'block';
        window.scrollTo({ top: parentSec.offsetTop - 20, behavior: 'smooth' });
      }

      // Hide mobile Radar FAB!
      const fab = document.getElementById('mobile-radar-fab');
      if (fab) fab.style.display = 'none';

      this.app.state.deepTracker.drop_point = 'Đang điền thông tin phụ huynh';
      this.app.pingServerDropOff();
    },

    validate() {
      const name = this.getParentName();
      const phone = this.getParentPhone();
      const email = this.getParentEmail();

      if (!name || !phone || !email) {
        alert('Ba mẹ vui lòng điền đầy đủ các thông tin liên hệ để nhận kết quả.');
        return false;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert('Địa chỉ email không hợp lệ. Vui lòng kiểm tra lại.');
        return false;
      }
      return true;
    },

    submit() {
      if (!this.validate()) return;

      const btn = document.getElementById('btn-final-submit');
      if (btn) {
        btn.disabled = true;
        btn.innerText = 'ĐANG GỬI KẾT QUẢ...';
      }

      const scores = ModuleSurvey.calculateScores();
      const childName = ModuleChildInfo.getChildName();
      const name = this.getParentName();
      const phone = this.getParentPhone();
      const email = this.getParentEmail();
      const age = ModuleChildInfo.getChildAge();
      const diagnosis = ModuleChildInfo.getChildDiagnosis();
      const therapy = ModuleChildInfo.getChildTherapy();
      const supplement = ModuleChildInfo.getChildSupplement();
      const concern = ModuleChildInfo.getParentConcern();
      const extraSymptomsEl = document.getElementById('extra-symptoms');
      const extra = extraSymptomsEl ? extraSymptomsEl.value.trim() : '';
      const gender = ModuleChildInfo.getChildGender();

      const behaviorsByGroup = {};
      scores.forEach(s => {
        if (s.tickedItems && s.tickedItems.length > 0) {
          behaviorsByGroup[s.id] = s.tickedItems;
        }
      });

      const timeSpent = Math.floor((Date.now() - this.app.state.startTime) / 1000);
      const deviceInfo = navigator.userAgent;

      const formData = new FormData();
      formData.append('action', 'hieucon_dh_submit_checklist');
      formData.append('user_code', this.app.state.userCode);
      formData.append('child_name', childName);
      formData.append('parent_name', name);
      formData.append('parent_phone', phone);
      formData.append('parent_email', email);
      formData.append('child_age', age);
      formData.append('child_diagnosis', diagnosis);
      formData.append('child_gender', gender);
      formData.append('child_height', ModuleChildInfo.getChildHeight());
      formData.append('child_weight', ModuleChildInfo.getChildWeight());
      formData.append('child_therapy', therapy);
      formData.append('child_supplement', supplement);
      formData.append('parent_concern', concern);
      formData.append('extra_symptoms', extra);
      formData.append('scores_json', JSON.stringify(scores));
      formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));

      this.app.state.deepTracker.drop_point = 'Hoàn thành 100%';
      this.app.state.deepTracker.activeTime += (Date.now() - this.app.state.deepTracker.lastFocus);
      this.app.state.deepTracker.lastFocus = Date.now();
      const da = {
        ...this.app.state.deepTracker,
        highlighted: Array.from(this.app.state.deepTracker.highlighted),
        activeTime: Math.floor(this.app.state.deepTracker.activeTime / 1000)
      };

      formData.append('time_spent', timeSpent);
      formData.append('device_info', deviceInfo);
      formData.append('deep_analytics', JSON.stringify(da));

      fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(res => {
          console.log('Saved checklist:', res);
          if (typeof fbq !== 'undefined') {
            fbq('track', 'Lead', { content_name: 'Complete DH Checklist' });
          }
          this.transitionToNextStep(email);
        })
        .catch(err => {
          console.error(err);
          this.transitionToNextStep(email);
        });
    },

    transitionToNextStep(email) {
      const survey = document.getElementById('survey-active-container');
      if (survey) survey.style.display = 'none';
      ModuleSuccess.show(email);
    }
  };

  // ==========================================
  // ── MODULE 4: HIỂN THỊ THÀNH CÔNG (ModuleSuccess) ──
  // ==========================================
  const ModuleSuccess = {
    app: null,

    init(appInstance) {
      this.app = appInstance;
    },

    show(email) {
      const emailDisp = document.getElementById('sent-email-display');
      if (emailDisp) {
        emailDisp.textContent = email;
      }

      const thankSec = document.getElementById('thankyou-section');
      if (thankSec) {
        thankSec.style.display = 'block';
        window.scrollTo({ top: thankSec.offsetTop - 20, behavior: 'smooth' });
      }
    }
  };

  // ==========================================
  // ── PHƯƠNG THỨC LIÊN KẾT GIAO DIỆN (Nút Bấm) ──
  // ==========================================
  function goToIntro() {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('start', '1');
    window.location.href = window.location.pathname + '?' + urlParams.toString();
  }

  function startChecklist() {
    ModuleChildInfo.submit();
  }

  function submitParentInfo() {
    ModuleParentInfo.submit();
  }

  function submitCTA() {
    const phone = document.getElementById('cta-phone').value.trim();
    if (!phone) { alert('Vui lòng nhập số điện thoại để đặt lịch.'); return; }
    alert(`Cảm ơn ba mẹ! Chuyên gia sẽ liên hệ qua số ${phone} trong vòng 24 giờ để tư vấn. Mã hồ sơ của con là: ${ChecklistApp.state.userCode}`);

    if (typeof fbq !== 'undefined') {
      fbq('track', 'Contact');
    }
  }

  // Mobile Radar Modal Toggle helper
  function toggleMobileRadar(show) {
    const sidebar = document.getElementById('survey-sidebar');
    const closeBtn = document.getElementById('close-radar-btn');
    if (sidebar) {
      if (show) {
        sidebar.classList.add('show-mobile-overlay');
        if (closeBtn) closeBtn.style.display = 'block';
      } else {
        sidebar.classList.remove('show-mobile-overlay');
        if (closeBtn) closeBtn.style.display = 'none';
      }
    }
  }

  // Toggle tooltips on click (mobile focus)
  function toggleTooltip(wrapperElement, event) {
    if (event) {
      event.stopPropagation();
      event.preventDefault();
    }
    const isActive = wrapperElement.classList.contains('active');

    // Close all open tooltips
    const allActive = document.querySelectorAll('.info-tooltip-wrapper.active');
    allActive.forEach(el => el.classList.remove('active'));

    // Toggle current one
    if (!isActive) {
      wrapperElement.classList.add('active');
    }
  }

  // Close tooltips when clicking outside
  document.addEventListener('click', function (event) {
    if (!event.target.closest('.info-tooltip-wrapper')) {
      const allActive = document.querySelectorAll('.info-tooltip-wrapper.active');
      allActive.forEach(el => el.classList.remove('active'));
    }
  });

  // ==========================================
  // ── BIỂU ĐỒ RADAR CHỈ SỐ Y SINH ──
  // ==========================================
  window.myRadarChart = null;

  function initializeRadarChart() {
    const ctx = document.getElementById('radarChartCanvas');
    if (!ctx || window.myRadarChart) return;

    const labels = ['TH', 'AU', 'GN', 'GQ', 'TD', 'CX', 'MD', 'VD'];
    const initialData = GROUPS.map(group => {
      const answers = ChecklistApp.state.answers[group.id];
      if (!answers) return 0;
      let score = 0;
      answers.forEach((ticked, index) => {
        if (ticked) score += (index + 1);
      });
      return Math.round((score / 15) * 100);
    });

    window.myRadarChart = new Chart(ctx, {
      type: 'radar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Tỷ lệ biểu hiện (%)',
          data: initialData,
          backgroundColor: 'rgba(255, 209, 84, 0.25)', // light yellow
          borderColor: '#FFD154', // theme yellow
          borderWidth: 2,
          pointBackgroundColor: '#002795', // theme navy
          pointBorderColor: '#FFD154',
          pointRadius: 4,
          pointHoverRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: 0
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            animation: false,
            callbacks: {
              title: function (context) {
                if (!context || !context.length || !context[0]) return '';
                const index = context[0].dataIndex;
                const fullNames = [
                  'Rối loạn tiêu hóa',
                  'Rối loạn ăn uống',
                  'Rối loạn giấc ngủ',
                  'Xử lý giác quan',
                  'Tăng động - Giảm chú ý',
                  'Cảm xúc - Hành vi',
                  'Miễn dịch - Dị ứng',
                  'Chức năng vận động'
                ];
                return fullNames[index] || '';
              },
              label: function (context) {
                if (!context || context.raw === undefined) return '';
                return 'Tỷ lệ biểu hiện: ' + context.raw + '%';
              }
            }
          }
        },
        scales: {
          r: {
            angleLines: {
              color: 'rgba(255, 255, 255, 0.15)'
            },
            grid: {
              color: 'rgba(255, 255, 255, 0.12)'
            },
            pointLabels: {
              display: true,
              color: 'rgba(255, 255, 255, 0.85)',
              font: {
                family: 'Quicksand, sans-serif',
                size: 10,
                weight: '700'
              }
            },
            ticks: {
              display: false,
              stepSize: 20
            },
            suggestedMin: 0,
            suggestedMax: 100
          }
        }
      }
    });

  }

  function updateRadarChartData() {
    if (!window.myRadarChart) return;

    const percentages = GROUPS.map(group => {
      const answers = ChecklistApp.state.answers[group.id];
      if (!answers) return 0;
      let score = 0;
      answers.forEach((ticked, index) => {
        if (ticked) score += (index + 1);
      });
      return Math.round((score / 15) * 100);
    });

    window.myRadarChart.data.datasets[0].data = percentages;
    window.myRadarChart.update();
  }

  // ==========================================
  // ── DEBUG CONTROLLER (ModuleDebug) ──
  // ==========================================
  const ModuleDebug = {
    activeScreen: 'survey',

    init() {
      const debugHtml = `
          <div id="debug-floating-panel" style="position: fixed; bottom: 20px; right: 20px; z-index: 999999; width: 320px; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.4); padding: 16px; font-family: system-ui, -apple-system, sans-serif; color: #f1f5f9; font-size: 13px; transition: all 0.3s ease;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 8px; margin-bottom: 12px;">
              <strong style="color: #fbbf24; font-size: 14px; display: flex; align-items: center; gap: 6px;">🛠️ DEBUG PANEL</strong>
              <button onclick="ModuleDebug.toggleMinimize()" style="background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 16px;">➖</button>
            </div>
            <div id="debug-panel-content">
              <div style="margin-bottom: 12px;">
                <div style="font-weight: 600; color: #38bdf8; margin-bottom: 6px;">BẬT/TẮT MÀN HÌNH:</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px;">
                  <button onclick="ModuleDebug.showScreen('hero')" class="debug-btn" id="db-btn-hero">1. Intro/Hero</button>
                  <button onclick="ModuleDebug.showScreen('info')" class="debug-btn" id="db-btn-info">2. Thông tin con</button>
                  <button onclick="ModuleDebug.showScreen('survey')" class="debug-btn" id="db-btn-survey">3. Checklist</button>
                  <button onclick="ModuleDebug.showScreen('parent')" class="debug-btn" id="db-btn-parent">4. Nhận kết quả</button>
                </div>
              </div>
              <div style="margin-bottom: 12px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                <div style="font-weight: 600; color: #34d399; margin-bottom: 6px;">TIỆN ÍCH NHANH:</div>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                  <button onclick="ModuleDebug.autoFillForms()" style="background: #059669; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">⚡ Điền nhanh thông tin</button>
                  <button onclick="ModuleDebug.autoCheckRandom()" style="background: #2563eb; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">🎲 Chọn ngẫu nhiên Checklist</button>
                </div>
              </div>
              <div style="margin-bottom: 12px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                <div style="font-weight: 600; color: #fb7185; margin-bottom: 6px;">XEM TRƯỚC MẪU (SLUG & MAIL):</div>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                  <button onclick="ModuleDebug.debugViewResult()" style="background: #e11d48; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">🌐 Xem trang kết quả mẫu</button>
                  <button onclick="ModuleDebug.previewEmailHtml()" style="background: #7c3aed; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center; transition: all 0.2s;">📧 Xem trước HTML Email</button>
                </div>
              </div>
              <div style="font-size: 11px; color: #64748b; text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 8px;">
                Nhấp chuột vào các nút để kiểm tra nhanh luồng chạy.
              </div>
            </div>
          </div>
          <style>
            .debug-btn {
              background: rgba(255, 255, 255, 0.08);
              border: 1px solid rgba(255, 255, 255, 0.1);
              color: #cbd5e1;
              padding: 6px;
              border-radius: 6px;
              cursor: pointer;
              font-size: 11px;
              font-weight: 500;
              text-align: center;
              transition: all 0.2s;
            }
            .debug-btn:hover {
              background: rgba(255, 255, 255, 0.15);
              color: #fff;
            }
            .debug-btn.active {
              background: #e11d48 !important;
              border-color: #e11d48 !important;
              color: white !important;
              font-weight: bold;
            }
          </style>
        `;
      const div = document.createElement('div');
      div.innerHTML = debugHtml;
      document.body.appendChild(div);

      // Auto show checklist as initial screen
      this.showScreen('survey');
    },

    toggleMinimize() {
      const content = document.getElementById('debug-panel-content');
      const panel = document.getElementById('debug-floating-panel');
      if (content.style.display === 'none') {
        content.style.display = 'block';
        panel.style.width = '320px';
      } else {
        content.style.display = 'none';
        panel.style.width = '160px';
      }
    },

    showScreen(screenId) {
      const hero = document.getElementById('hero-section');
      const info = document.getElementById('info-section');
      const survey = document.getElementById('survey-active-container');
      const parent = document.getElementById('parent-info-section');
      const thankyou = document.getElementById('thankyou-section');
      const surveyPageContainer = document.getElementById('survey-page-container');

      if (hero) hero.style.display = 'none';
      if (info) info.style.display = 'none';
      if (survey) survey.style.display = 'none';
      if (parent) parent.style.display = 'none';
      if (thankyou) thankyou.style.display = 'none';
      if (surveyPageContainer) surveyPageContainer.style.display = 'none';
      // Hide survey grid unless survey screen is active
      if (survey) survey.style.display = 'none';

      document.querySelectorAll('.debug-btn').forEach(btn => btn.classList.remove('active'));

      if (screenId === 'hero') {
        if (hero) hero.style.display = 'block';
        const btn = document.getElementById('db-btn-hero');
        if (btn) btn.classList.add('active');
      } else if (screenId === 'info') {
        if (surveyPageContainer) surveyPageContainer.style.display = 'block';
        if (info) info.style.display = 'block';
        const btn = document.getElementById('db-btn-info');
        if (btn) btn.classList.add('active');
      } else if (screenId === 'survey') {
        if (survey) survey.style.display = 'grid';
        if (thankyou) thankyou.style.display = 'none';
        const checklistContainer = document.getElementById('checklist-container');
        if (checklistContainer) checklistContainer.style.display = 'block';
        const btn = document.getElementById('db-btn-survey');
        if (btn) btn.classList.add('active');
        if (ModuleSurvey && typeof ModuleSurvey.start === 'function') {
          ModuleSurvey.start();
        }
        if (typeof initializeRadarChart === 'function') {
          initializeRadarChart();
        }
        if (typeof updateRadarChartData === 'function') {
          updateRadarChartData();
        }
      } else if (screenId === 'parent') {
        if (survey) survey.style.display = 'block';
        if (parent) parent.style.display = 'block';
        const checklistContainer = document.getElementById('checklist-container');
        if (checklistContainer) checklistContainer.style.display = 'none';
        const btn = document.getElementById('db-btn-parent');
        if (btn) btn.classList.add('active');
      }
    },

    autoFillForms() {
      const fields = {
        'child-name': 'Nguyễn Khánh An',
        'child-age': '5',
        'child-height': '110',
        'child-weight': '18',
        'child-therapy': 'Can thiệp ngôn ngữ tuần 3 buổi',
        'child-supplement': 'DHA, Kẽm, Vitamin D3 K2',
        'parent-concern': 'Con chậm nói, giao tiếp mắt kém, thỉnh thoảng nhón gót',
        'parent-name': 'Nguyễn Văn Minh',
        'parent-phone': '0987654321',
        'parent-email': 'parent.test@gmail.com'
      };

      for (const [id, val] of Object.entries(fields)) {
        const el = document.getElementById(id);
        if (el) {
          el.value = val;
          el.dispatchEvent(new Event('change'));
          el.dispatchEvent(new Event('input'));
        }
      }

      const genderMale = document.getElementById('gender-male') || document.querySelector('input[value="Nam"]');
      if (genderMale) {
        genderMale.checked = true;
        genderMale.dispatchEvent(new Event('change'));
      }

      const diagnosisCheckboxes = document.querySelectorAll('#info-section input[type="checkbox"]');
      if (diagnosisCheckboxes.length > 0) {
        diagnosisCheckboxes[0].checked = true;
        diagnosisCheckboxes[0].dispatchEvent(new Event('change'));
      }

      alert('Đã điền tự động toàn bộ biểu mẫu thông tin thành công!');
    },

    autoCheckRandom() {
      if (!ModuleSurvey || !ModuleSurvey.app) return;

      GROUPS.forEach((group, gi) => {
        group.items.forEach((_, ii) => {
          const isYes = Math.random() > 0.4;
          const checkbox = document.getElementById(`opt-yes-${gi}-${ii}`);
          if (checkbox) {
            checkbox.checked = isYes;
            ModuleSurvey.toggleItemCheckbox(gi, ii, checkbox);
          }
        });
      });

      alert('Đã tích chọn ngẫu nhiên toàn bộ 40 câu hỏi checklist thành công!');
    },

    debugViewResult() {
      if (!ModuleChildInfo.getChildName()) {
        this.autoFillForms();
      }
      const scores = ModuleSurvey.calculateScores();
      const hasTicked = scores.some(s => s.ticked > 0);
      if (!hasTicked) {
        this.autoCheckRandom();
      }

      const childName = ModuleChildInfo.getChildName();
      const name = ModuleParentInfo.getParentName() || 'Phụ huynh Test';
      const phone = ModuleParentInfo.getParentPhone() || '0987654321';
      const email = ModuleParentInfo.getParentEmail() || 'test@gmail.com';
      const age = ModuleChildInfo.getChildAge();
      const diagnosis = ModuleChildInfo.getChildDiagnosis();
      const therapy = ModuleChildInfo.getChildTherapy();
      const supplement = ModuleChildInfo.getChildSupplement();
      const concern = ModuleChildInfo.getParentConcern();
      const gender = ModuleChildInfo.getChildGender();
      const height = ModuleChildInfo.getChildHeight();
      const weight = ModuleChildInfo.getChildWeight();

      const latestScores = ModuleSurvey.calculateScores();
      const behaviorsByGroup = {};
      latestScores.forEach(s => {
        if (s.tickedItems && s.tickedItems.length > 0) {
          behaviorsByGroup[s.id] = s.tickedItems;
        }
      });

      const formData = new FormData();
      formData.append('action', 'hieucon_dh_submit_checklist');
      formData.append('user_code', ChecklistApp.state.userCode || Math.floor(10000000 + Math.random() * 90000000).toString());
      formData.append('child_name', childName);
      formData.append('parent_name', name);
      formData.append('parent_phone', phone);
      formData.append('parent_email', email);
      formData.append('child_age', age);
      formData.append('child_diagnosis', diagnosis);
      formData.append('child_gender', gender);
      formData.append('child_height', height);
      formData.append('child_weight', weight);
      formData.append('child_therapy', therapy);
      formData.append('child_supplement', supplement);
      formData.append('parent_concern', concern);
      formData.append('scores_json', JSON.stringify(latestScores));
      formData.append('behaviors_json', JSON.stringify(behaviorsByGroup));
      formData.append('time_spent', 120);
      formData.append('device_info', navigator.userAgent);

      fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
      })
        .then(res => res.json())
        .then(res => {
          const code = (res && res.data && res.data.user_code) ? res.data.user_code : ChecklistApp.state.userCode;
          window.open(`<?php echo site_url('/ket-qua-dh?code='); ?>` + code, '_blank');
        })
        .catch(err => {
          window.open(`<?php echo site_url('/ket-qua-dh?code='); ?>` + ChecklistApp.state.userCode, '_blank');
        });
    },

    previewEmailHtml() {
      const scores = ModuleSurvey.calculateScores();
      let topIssuesHtml = '';
      let count = 0;
      scores.forEach(s => {
        if (count >= 3) return;
        if (s.pct > 0) {
          topIssuesHtml += `
              <li style="margin-bottom: 12px; font-size: 15px; line-height: 1.6;">
                <strong style="color: #be123c;">🚨 \${s.name}:</strong> 
                Ghi nhận <strong>\${s.ticked}/\${s.total}</strong> dấu hiệu (\${s.pct}%)
              </li>`;
          count++;
        }
      });
      if (!topIssuesHtml) {
        topIssuesHtml = '<li style="font-size: 15px; color: #475569; font-style: italic;">Chưa ghi nhận dấu hiệu bất thường nổi bật nào.</li>';
      }

      const userCode = ChecklistApp.state.userCode || '12345678';
      const resultUrl = `${window.location.origin}/ket-qua-dh?code=\${userCode}`;
      const parentName = ModuleParentInfo.getParentName() || 'Nguyễn Văn A';
      const childName = ModuleChildInfo.getChildName() || 'Bé An';
      const childAge = ModuleChildInfo.getChildAge() || '5 tuổi';
      const childGender = ModuleChildInfo.getChildGender() || 'Bé trai';

      const emailHtml = `
          <!DOCTYPE html>
          <html>
          <body style="margin: 0; padding: 20px; background-color: #f1f5f9; font-family: system-ui, -apple-system, sans-serif;">
            <div style="max-width: 600px; margin: 0 auto 10px; background: #0f172a; padding: 12px; border-radius: 8px; text-align: center; font-weight: bold; color: #fbbf24; font-family: sans-serif; font-size: 13px; border: 1px solid rgba(255,255,255,0.15);">
              📧 ĐANG XEM TRƯỚC GIAO DIỆN EMAIL GỬI KHÁCH HÀNG (MOCKUP)
            </div>
            
            <div class="wrapper" style="width: 100%; background-color: #EBF1FA; padding: 24px 10px; box-sizing: border-box;">
                <table role="presentation" width="100%" style="border-spacing: 0; border-collapse: collapse;">
                    <tr>
                        <td align="center">
                            <div class="main-container" style="background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 580px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(13, 42, 120, 0.08); border: 1px solid #D6E2F5; text-align: left; font-family: sans-serif;">
                                
                                <!-- Header Banner -->
                                <div class="header" style="background: linear-gradient(150deg, #0A2268 0%, #0D2A78 50%, #163CA3 100%); padding: 24px 24px 20px 24px; text-align: center; color: #ffffff;">
                                    <div class="badge-pill" style="display: inline-block; background: rgba(255, 255, 255, 0.15); padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; color: #F3BA2F; border: 1px solid rgba(255, 255, 255, 0.2); margin-bottom: 10px;">🟡 HIỂU CON TỪ GỐC</div>
                                    <h1 style="margin: 0; font-size: 20px; line-height: 1.35; font-weight: 800; color: #FFFFFF; letter-spacing: 0.5px; text-transform: uppercase;">
                                        CÔNG CỤ ĐÁNH GIÁ
                                        <span class="highlight" style="color: #F3BA2F; display: block;">SỨC KHỎE TOÀN DIỆN</span>
                                    </h1>
                                </div>

                                <!-- Main Content Body -->
                                <div class="content" style="padding: 24px 24px 20px 24px;">
                                    <!-- Code Badge & Greeting -->
                                    <div style="margin-bottom: 14px;">
                                        <span class="profile-badge" style="display: inline-block; background-color: #F0F5FF; border: 1px solid #C7DCFE; color: #163CA3; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700;">Mã hồ sơ: \${userCode}</span>
                                    </div>
                                    <div class="greeting" style="font-size: 15px; line-height: 1.4; color: #0D2A78; font-weight: 700; margin-bottom: 10px;">Xin chào \${parentName},</div>
                                    
                                    <!-- Streamlined Result Link Section -->
                                    <div class="result-compact-box" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 18px 16px; margin: 16px 0 20px 0; text-align: center;">
                                        <div class="result-compact-text" style="font-size: 13px; line-height: 1.5; color: #334155; margin-bottom: 12px;">
                                            Kết quả đánh giá của bé đã hoàn tất. Ba mẹ có thể xem chi tiết trực tiếp tại đường link: <br>
                                            <a href="\${resultUrl}" target="_blank" style="color: #0284C7; font-weight: 600; word-break: break-all; text-decoration: underline;">\${resultUrl}</a>
                                        </div>
                                        <a href="\${resultUrl}" class="btn-view-report" target="_blank" style="background-color: #0D2A78; color: #ffffff !important; padding: 12px 24px; text-decoration: none; font-size: 14px; font-weight: 700; border-radius: 8px; display: inline-block; box-shadow: 0 3px 10px rgba(13, 42, 120, 0.2); transition: background-color 0.2s ease;">
                                            Kết quả: \${userCode}
                                        </a>
                                    </div>

                                    <!-- Disclaimer Box -->
                                    <div class="disclaimer-box" style="background-color: #FAF5FF; border: 1px solid #E9D5FF; border-radius: 8px; padding: 12px 14px; margin-top: 20px; font-size: 11px; color: #6B21A8; line-height: 1.5;">
                                        <strong style="color: #581C87;">⚠️ Lưu ý:</strong> Kết quả từ bộ công cụ mang tính chất tổng hợp thông tin quan sát nhằm hỗ trợ ba mẹ định hướng theo dõi. Đây không phải là kết luận hay chẩn đoán y khoa chính thức.
                                    </div>

                                </div>

                                <!-- Refined Minimalist Footer with Subtle Nav -->
                                <div class="footer" style="background-color: #0F172A; color: #94A3B8; padding: 22px 20px; text-align: center; font-size: 12px; line-height: 1.5;">
                                    <!-- Subtle Footer Navigation -->
                                    <div class="footer-nav" style="border-bottom: none; padding-bottom: 6px; margin-bottom: 10px;">
                                        <a href="https://zalo.me/0985391881" class="footer-link-btn footer-btn-tuvan" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(255, 107, 0, 0.15); color: #FF9E59 !important; border: 1px solid rgba(255, 107, 0, 0.3);">
                                            Tư vấn
                                        </a>
                                        <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" class="footer-link-btn footer-btn-hoidap" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(56, 189, 248, 0.12); color: #38BDF8 !important; border: 1px solid rgba(56, 189, 248, 0.25);">
                                            Hỏi đáp
                                        </a>
                                        <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" class="footer-link-btn footer-btn-congdong" target="_blank" style="display: inline-block; text-decoration: none; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; margin: 0 3px 6px 3px; background-color: rgba(241, 245, 249, 0.1); color: #E2E8F0 !important; border: 1px solid rgba(241, 245, 249, 0.2);">
                                            Cộng đồng
                                        </a>
                                    </div>

                                    <div style="font-size: 11px; color: #94A3B8;">
                                        © 2026 Hiểu Con Từ Gốc | <a href="https://hieucontugoc.online" class="site-link" target="_blank" style="color: #F3BA2F; text-decoration: none; font-weight: 700;">hieucontugoc.online</a>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
          </body>
          </html>`;

      const win = window.open("", "_blank");
      win.document.write(emailHtml);
      win.document.close();
    }
  };

  // ==========================================
  // ── DOM READY INITIALIZATION ──
  // ==========================================
  document.addEventListener('DOMContentLoaded', () => {
    ChecklistApp.init();
    // ModuleDebug.init();

    // Client-side routing to support server-side page caching
    const urlParams = new URLSearchParams(window.location.search);
    const hero = document.getElementById('hero-section');
    const childInfo = document.getElementById('survey-page-container');
    const activeSurvey = document.getElementById('survey-active-container');
    const parentInfo = document.getElementById('parent-info-section');
    const thankyou = document.getElementById('thankyou-section');
    const progressWrap = document.getElementById('progress-wrap');
    const resultPage = document.getElementById('result-page');

    if (urlParams.has('start')) {
      if (hero) hero.style.display = 'none';
      if (childInfo) childInfo.style.display = 'block';
      if (activeSurvey) activeSurvey.style.display = 'none';
      if (parentInfo) parentInfo.style.display = 'none';
      if (thankyou) thankyou.style.display = 'none';
      if (progressWrap) progressWrap.style.display = 'none';
      if (resultPage) resultPage.style.display = 'none';
    } else {
      if (hero) hero.style.display = 'block';
      if (childInfo) childInfo.style.display = 'none';
      if (activeSurvey) activeSurvey.style.display = 'none';
      if (parentInfo) parentInfo.style.display = 'none';
      if (thankyou) thankyou.style.display = 'none';
      if (progressWrap) progressWrap.style.display = 'none';
      if (resultPage) resultPage.style.display = 'none';
    }
  });
</script>
